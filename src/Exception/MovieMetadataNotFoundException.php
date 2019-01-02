<?php
declare(strict_types = 1);

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class MovieNotFoundException
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class MovieMetadataNotFoundException extends HttpException
{
    /**
     * MovieNotFoundException constructor.
     *
     * @param \Exception|null $previous
     */
    public function __construct(\Exception $previous = null)
    {
        $message = sprintf('Metadata for movie with this title or IMDB Id was not found');

        parent::__construct(Response::HTTP_NOT_FOUND, $message, $previous);
    }
}