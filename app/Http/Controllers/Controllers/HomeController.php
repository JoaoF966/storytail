<?php

namespace App\Http\Controllers\Controllers;
use App\Models\Category;


use App\Services\BookService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        private readonly BookService $bookService
    ) {
    }

    public function index(): View
    {
        $thisMonthBooks = $this->bookService->getCurrentMonthBooks();
        $justAddedBooks = $this->bookService->getJustAddedBooks();
        $topReadBooks = $this->bookService->getTopReadBooks();

        return view('home.index', [
            'thisMonthBooks' => $thisMonthBooks,
            'justAddedBooks' => $justAddedBooks,
            'topReadBooks' => $topReadBooks,

        ]);
    }


}
