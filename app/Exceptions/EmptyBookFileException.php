<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class EmptyBookFileException extends BadRequestHttpException
{
    public static function fromBookFilename(string $bookFilename): self
    {
        return new static(sprintf('Provided book file is empty: "%s"', $bookFilename));
    }
}
