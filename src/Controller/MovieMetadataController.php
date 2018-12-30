<?php
declare(strict_types = 1);

namespace App\Controller;

use FOS\RestBundle\View\View;
use App\Service\MovieMetadataFetcher\Fetcher;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class MovieMetaDataController
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class MovieMetadataController extends FOSRestController
{
    /**
     * @var Fetcher
     */
    private $metaDataFetcher;

    /**
     * MovieMetadataController constructor.
     *
     * @param Fetcher $metaDataFetcher
     */
    public function __construct(Fetcher $metaDataFetcher)
    {
        $this->metaDataFetcher = $metaDataFetcher;
    }

    /**
     * @Rest\Get("/movie-meta/{imdbId}")
     *
     * @param string $imdbId
     * @return View
     */
    public function show(string $imdbId): View
    {
        $movie = $this->metaDataFetcher->fetchByIMDBId($imdbId);

        return new View($movie);
    }

    /**
     * @Rest\Get("/movie-meta-search")
     *
     * @param Request $request
     * @return View
     */
    public function search(Request $request): View
    {
        $title = $request->get('title');
        $movie = $this->metaDataFetcher->fetchByTitle($title);

        return new View($movie);
    }
}