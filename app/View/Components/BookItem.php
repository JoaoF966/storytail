<?php

namespace App\View\Components;

use App\Models\Book;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BookItem extends Component
{
    public function __construct(
        public readonly Book $book
    ) {
    }

    public function render(): View
    {
        return view('components.book-item');
    }
}
