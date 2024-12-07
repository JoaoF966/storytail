<?php

namespace App\Http\Filters;

use Illuminate\Http\Request;
use Webmozart\Assert\Assert;

class BookFilter
{
    public readonly int $page;

    public function __construct(int $page)
    {
        Assert::positiveInteger($page, 'Page must be a positive integer');

        $this->page = $page;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('page', 1)
        );
    }
}
