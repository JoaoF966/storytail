<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AgeGroupNotFoundException extends NotFoundHttpException
{
    public static function fromId(int $id): self
    {
        return new static(sprintf('Age group with ID %d not found', $id));
    }
}
