<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Throwable;

class BadCredentialsException extends AbstractDataAwareHttpException
{
    /**
     * @param string $message
     * @param array|null $data
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        string $message = 'user.disabled',
        ?array $data = null,
        int $statusCode = Response::HTTP_NOT_IMPLEMENTED,
        Throwable $previous = null,
        array $headers = [],
        int $code = 0,
    ) {
        parent::__construct($message, $data, $statusCode, $previous, $headers, $code);
    }
}
