<?php
declare(strict_types = 1);

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class CommunicationErrorException
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class CommunicationErrorException extends HttpException
{
    /**
     * CommunicationErrorException constructor.
     *
     * @param string $message
     * @param \Exception|null $previous
     */
    public function __construct(string $message, \Exception $previous = null)
    {
        parent::__construct(Response::HTTP_BAD_GATEWAY, $message, $previous);
    }
}