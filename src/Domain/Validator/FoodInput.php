<?php

namespace App\Domain\Validator;

use App\Domain\Exceptions\FoodNameException;
use Symfony\Component\Console\Input\InputInterface;

class FoodInput
{
    public function validate(string $foodName)
    {
        if ($foodName === null) {
            throw new FoodNameException();
        }
    }
}