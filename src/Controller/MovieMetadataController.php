<?php
declare(strict_types = 1);

namespace App\Controller;

use App\Entity\MovieMetadata;
use FOS\RestBundle\View\View;
use App\Service\MovieMetadataFetcher\Fetcher;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Exception\TitleOrImdbIdRequieredException;

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
     * @Rest\Get("/movie-meta-search")
     *
     * @param Request $request
     * @return View
     */
    public function search(Request $request): View
    {
        $movie = $this->getMetadataByRequest($request);

        return new View($movie);
    }

    /**
     * Get metadata by request parameters
     *
     * @param Request $request
     * @return MovieMetadata|null
     */
    private function getMetadataByRequest(Request $request): ?MovieMetadata
    {
        if ($request->query->has('imdbId')){
            return $movie = $this->metaDataFetcher->fetchByIMDBId(
                $request->get('imdbId')
            );
        }

        if ($request->query->has('title')){
            return $movie = $this->metaDataFetcher->fetchByTitle(
                $request->get('title')
            );
        }

        throw new TitleOrImdbIdRequieredException();
    }
}