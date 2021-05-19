<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

use Exception;
use Throwable;

class FoodNotFoundException extends Exception
{
    public function __construct($message = "O prato não existe", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}