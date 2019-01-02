<?php
declare(strict_types = 1);

namespace App\Service\MovieMetadataFetcher;

use GuzzleHttp\Client;
use App\Entity\MovieMetadata;
use App\Integration\OMDB\DTO\Movie;
use App\Integration\OMDB\DTO\Rating;
use JMS\Serializer\SerializerInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Exception\CommunicationErrorException;
use App\Exception\MovieMetadataNotFoundException;

/**
 * Class MovieMetadataFetcher
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class Fetcher
{
    /**
     * Response from metadata provider when movie was not found
     *
     * @var string
     */
    private const MOVIE_NOT_FOUND_TITLE = 'Movie not found!';

    /**
     * @var string
     */
    private const IMDB_SOURCE_NAME = 'Internet Movie Database';

    /**
     * @var string
     */
    private const ROTTEN_TOMATOES_SOURCE_NAME = 'Rotten Tomatoes';

    /**
     * @var Client
     */
    private $restClient;

    /**
     * @var string
     */
    private $apiUrl;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * Fetcher constructor.
     *
     * @param Client              $restClient
     * @param SerializerInterface $serializer
     * @param string              $apiUrl
     * @param string              $apiKey
     */
    public function __construct(Client $restClient, SerializerInterface $serializer, string $apiUrl, string $apiKey)
    {
        $this->restClient = $restClient;
        $this->serializer = $serializer;
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
    }

    /**
     * @param string $imdbId
     * @return MovieMetadata
     *
     * @throws \Exception
     */
    public function fetchByIMDBId(string $imdbId): MovieMetadata
    {
        $url = sprintf('%s?i=%s&apikey=%s', $this->apiUrl, $imdbId, $this->apiKey);
        $movie = $this->fetchMovie($url);

        return $this->parseToMovieMetadata($movie);
    }

    /**
     * Fetch movie by name
     *
     * @param string $title
     * @return MovieMetadata
     */
    public function fetchByTitle(string $title): MovieMetadata
    {
        $url = sprintf('%s?t=%s&apikey=%s', $this->apiUrl, $title, $this->apiKey);
        $movie = $this->fetchMovie($url);

        return $this->parseToMovieMetadata($movie);
    }

    /**
     * Fetch movie from Open Movie Database
     *
     * @param string $url
     * @return Movie
     * @throws \Exception
     */
    private function fetchMovie(string $url): Movie
    {
        $response = $this->restClient->get($url);

        if ($response->getStatusCode() !== Response::HTTP_OK){
            throw new CommunicationErrorException('Communication error with Open Movie Database');
        }

        $movie = $this->deserializeResponse($response);

        if ($movie->getError() === self::MOVIE_NOT_FOUND_TITLE){
            throw new MovieMetadataNotFoundException();
        }

        if ($movie->getResponse() !== 'True'){
            throw new CommunicationErrorException($movie->getError());
        }

        return $movie;
    }

    /**
     * Deserialize response to our internal DTO
     *
     * @param ResponseInterface $response
     * @return Movie
     */
    private function deserializeResponse(ResponseInterface $response): Movie
    {
        return $this->serializer->deserialize(
            (string)$response->getBody(),
            Movie::class,
            'json'
        );
    }

    /**
     * Parse MovieDTO to domain entity
     *
     * @param Movie $movieDTO
     * @return MovieMetadata
     */
    private function parseToMovieMetadata(Movie $movieDTO): MovieMetadata
    {
        $imdbRating = $this->getRatingBySourceName($movieDTO, self::IMDB_SOURCE_NAME);
        $rottenTomatoesRating = $this->getRatingBySourceName($movieDTO, self::ROTTEN_TOMATOES_SOURCE_NAME);
        $boxOffice = $movieDTO->getBoxOffice() !== 'N/A'
            ? $this->parseStringToFloat($movieDTO->getBoxOffice())
            : null;

        $dateReleased = $movieDTO->getReleased() !== 'N/A'
            ? new \DateTime($movieDTO->getReleased())
            : null;

        return new MovieMetadata(
            $movieDTO->getRated(),
            $dateReleased,
            $movieDTO->getGenre(),
            $movieDTO->getDirector(),
            $movieDTO->getWriter(),
            $movieDTO->getPlot(),
            $movieDTO->getPoster(),
            $imdbRating,
            $rottenTomatoesRating,
            $boxOffice
        );
    }

    /**
     * Get movie rating by source name
     *
     * @param Movie $movie
     * @param string $sourceName
     * @return float
     */
    private function getRatingBySourceName(Movie $movie, string $sourceName): ?float
    {
        /** @var Rating[] $ratings */
        $ratings = array_filter($movie->getRatings(), function(Rating $rating) use ($sourceName){
            return $rating->getSource() === $sourceName;
        });

        if (count($ratings) === 0){
            return null;
        }

        $rating = current($ratings);
        $value = preg_replace('|/.*$|', '', $rating->getValue());

        return $this->parseStringToFloat($value);
    }

    /**
     * Parse string number to float
     *
     * @param string $number
     * @return Float
     */
    private function parseStringToFloat(string $number): Float
    {
        return (float)preg_replace('/[^0-9.]/', "", $number);
    }
}