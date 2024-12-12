<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BookNotFoundException extends NotFoundHttpException
{
    public static function fromId(int $id): self
    {
        return new static(sprintf('Book with ID %d not found', $id));

    }
}
