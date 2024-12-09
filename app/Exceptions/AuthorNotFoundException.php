<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthorNotFoundException extends NotFoundHttpException
{
    public static function fromId(int $id): self
    {
        return new static(sprintf('Author with ID %d not found', $id));
    }
}
