<?php

namespace App\Http\Controllers;

use App\Http\Filters\BookFilter;
use App\Services\BookService;
use Illuminate\Http\Request;
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

        $id = $thisMonthBooks->get(0)->id;

        return view('home.index', [
            'thisMonthBooks' => $thisMonthBooks,
            'justAddedBooks' => $justAddedBooks,
            'topReadBooks' => $topReadBooks,
        ]);
    }

    public function search(Request $request): View
    {
        BookFilter::fromRequest($request);

        return view('home.search');
    }
}
