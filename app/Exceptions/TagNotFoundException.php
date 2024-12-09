<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TagNotFoundException extends NotFoundHttpException
{
    public static function fromId(int $id): self
    {
        return new static(sprintf('Tag with ID %d not found', $id));

    }
}
