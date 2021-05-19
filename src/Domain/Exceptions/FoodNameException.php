<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

use Exception;
use Throwable;

class FoodNameException extends Exception
{
    public function __construct($message = "O nome do prato não é válido", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}