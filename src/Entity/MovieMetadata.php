<?php
declare(strict_types = 1);

namespace App\Entity;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class MovieMetadata
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
final class MovieMetadata
{
    /**
     * @var string
     */
    private $rated;

    /**
     * @var \DateTimeInterface
     * @Serializer\SerializedName("dateReleased")
     * @Serializer\Type("DateTime")
     */
    private $dateReleased;

    /**
     * @var string
     */
    private $genre;

    /**
     * @var string
     */
    private $director;

    /**
     * @var string
     */
    private $writers;

    /**
     * @var string
     */
    private $plot;

    /**
     * @var string
     * @Serializer\SerializedName("posterUrl")
     */
    private $posterUrl;

    /**
     * @var float
     * @Serializer\SerializedName("imdbRating")
     */
    private $imdbRating;

    /**
     * @var float
     * @Serializer\SerializedName("rottenTomatoesRating")
     */
    private $rottenTomatoesRating;

    /**
     * @var float
     * @Serializer\SerializedName("boxOffice")
     */
    private $boxOffice;

    /**
     * MovieMetadata constructor.
     *
     * @param string $rated
     * @param \DateTimeInterface $dateReleased
     * @param string $genre
     * @param string $director
     * @param string $writers
     * @param string $plot
     * @param string $posterUrl
     * @param float $imdbRating
     * @param float $rottenTomatoesRating
     * @param float $boxOffice
     */
    public function __construct(string $rated, ?\DateTimeInterface $dateReleased, string $genre, string $director, string $writers, string $plot, string $posterUrl, ?float $imdbRating, ?float $rottenTomatoesRating, ?float $boxOffice)
    {
        $this->rated = $rated;
        $this->dateReleased = $dateReleased;
        $this->genre = $genre;
        $this->director = $director;
        $this->writers = $writers;
        $this->plot = $plot;
        $this->posterUrl = $posterUrl;
        $this->imdbRating = $imdbRating;
        $this->rottenTomatoesRating = $rottenTomatoesRating;
        $this->boxOffice = $boxOffice;
    }
}