<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

interface DataAwareExceptionInterface extends Throwable
{
    /**
     * Returns the exception's data
     * @return array|null
     */
    public function getData(): ?array;
}
