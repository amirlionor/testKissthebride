<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

abstract class AbstractDataAwareHttpException extends HttpException implements DataAwareExceptionInterface
{
    private ?array $data = null;


    /**
     * @param string $message
     * @param array|null $data
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        string $message = '',
        ?array $data = null,
        int $statusCode = 0,
        Throwable $previous = null,
        array $headers = [],
        int $code = 0,
    ) {
        parent::__construct($statusCode, $message, $previous, $headers, $code);
        $this->data = $data;
    }


    /**
     * @return array|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }


    /**
     * Allow changing the excetion's message
     *
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}
