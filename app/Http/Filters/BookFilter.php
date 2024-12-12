<?php

namespace App\Http\Filters;

use Illuminate\Http\Request;
use Webmozart\Assert\Assert;

class BookFilter
{
    public readonly int $page;
    public readonly ?string $search;

    public function __construct(int $page, string $search = null)
    {
        Assert::positiveInteger($page, 'Page must be a positive integer');

        $this->page = $page;
        $this->search = $search;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('page', 1),
            $request->input('search')
        );
    }
}
