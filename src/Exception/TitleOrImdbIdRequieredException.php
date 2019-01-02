<?php
declare(strict_types = 1);

namespace App\Exception;

use Throwable;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class TitleOrImdbIdRequieredException
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class TitleOrImdbIdRequieredException extends HttpException
{
    /**
     * TitleOrImdbIdRequieredException constructor.
     *
     * @param Throwable|null $previous
     */
    public function __construct(\Exception $previous = null)
    {
        $message = sprintf('One of either query parameter "imdbId" or "title" is required to search metadata');

        parent::__construct(Response::HTTP_BAD_REQUEST, $message, $previous);
    }
}