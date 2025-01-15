<?php

namespace App\View\Components;

use App\Models\Book;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class BookList extends Component
{
    /**
     * @param Collection<Book> $books
     */
    public function __construct(
        public readonly string $title,
        public readonly Collection $books
    ) {
    }

    public function render(): View
    {
        return view('components.book-list');
    }
}
