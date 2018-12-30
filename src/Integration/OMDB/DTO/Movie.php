<?php
declare(strict_types = 1);

namespace App\Integration\OMDB\DTO;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class MovieMetadata
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class Movie
{
    /**
     * @var string
     *
     * @Type("string")
     * @Serializer\SerializedName("Title")
     */
    private $title;

    /**
     * @var string
     *
     * @Type("string")
     * @Serializer\SerializedName("Year")
     */
    private $year;

    /**
     * @var string
     *
     * @Type("string")
     * @Serializer\SerializedName("Rated")
     */
    private $rated;

    /**
     * @var string
     *
     * @Type("string")
     * @Serializer\SerializedName("Released")
     */
    private $released;

    /**
     * @var string
     *
     * @Type("string")
     * @Serializer\SerializedName("Runtime")
     */
    private $runtime;

    /**
     * @var string
     *
     * @Type("string")
     * @Serializer\SerializedName("Genre")
     */
    private $genre;

    /**
     * @var string
     *
     * @Type("string")
     * @Serializer\SerializedName("Director")
     */
    private $director;

    /**
     * @var string
     *
     * @Type("string")
     * @Serializer\SerializedName("Writer")
     */
    private $writer;

    /**
     * @var string
     *
     * @Type("string")
     * @Serializer\SerializedName("Actors")
     */
    private $actors;

    /**
     * @var string
     *
     * @Type("string")
     * @Serializer\SerializedName("Plot")
     */
    private $plot;

    /**
     * @var string
     *
     * @Type("string")
     * @Serializer\SerializedName("Language")
     */
    private $language;

    /**
     * @var string
     *
     * @Type("string")
     * @Serializer\SerializedName("Country")
     */
    private $country;

    /**
     * @var string
     *
     * @Type("string")
     * @Serializer\SerializedName("Awards")
     */
    private $awards;

    /**
     * @var string
     *
     * @Type("string")
     * @Serializer\SerializedName("Poster")
     */
    private $poster;

    /**
     * @var Rating[]
     *
     * @Type("array<App\Integration\OMDB\DTO\Rating>")
     * @Serializer\SerializedName("Ratings")
     */
    private $ratings;

    /**
     * @var string
     *
     * @Type("string")
     * @Serializer\SerializedName("BoxOffice")
     */
    private $boxOffice;

    /**
     * @var string
     *
     * @Type("string")
     * @Serializer\SerializedName("Response")
     */
    private $response;

    /**
     * @var string
     *
     * @Type("string")
     * @Serializer\SerializedName("Error")
     */
    private $error;

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Get year released
     *
     * @return string
     */
    public function getYear(): string
    {
        return $this->year;
    }

    /**
     * Get rated
     *
     * @return string
     */
    public function getRated(): string
    {
        return $this->rated;
    }

    /**
     * Get released date
     *
     * @return string
     */
    public function getReleased(): string
    {
        return $this->released;
    }

    /**
     * Get length
     *
     * @return string
     */
    public function getRuntime(): string
    {
        return $this->runtime;
    }

    /**
     * Get genre
     *
     * @return string
     */
    public function getGenre(): string
    {
        return $this->genre;
    }

    /**
     * Get directors
     *
     * @return string
     */
    public function getDirector(): string
    {
        return $this->director;
    }

    /**
     * Get writers
     *
     * @return string
     */
    public function getWriter(): string
    {
        return $this->writer;
    }

    /**
     * Get actors
     *
     * @return string
     */
    public function getActors(): string
    {
        return $this->actors;
    }

    /**
     * Get plot
     *
     * @return string
     */
    public function getPlot(): string
    {
        return $this->plot;
    }

    /**
     * Get Language
     *
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * Get awards
     *
     * @return string
     */
    public function getAwards(): string
    {
        return $this->awards;
    }

    /**
     * Get poster
     *
     * @return string
     */
    public function getPoster(): string
    {
        return $this->poster;
    }

    /**
     * Get ratings
     *
     * @return Rating[]
     */
    public function getRatings(): array
    {
        return $this->ratings;
    }

    /**
     * Get box office amount
     *
     * @return string
     */
    public function getBoxOffice(): string
    {
        return $this->boxOffice;
    }

    /**
     * Get API response
     *
     * @return string
     */
    public function getResponse(): string
    {
        return $this->response;
    }

    /**
     * Get API error
     *
     * @return string
     */
    public function getError(): ?string
    {
        return $this->error;
    }
}