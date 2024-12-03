<?php

namespace App\Http\Controllers;

use App\Services\BookService;

class HomeController extends Controller
{
    public function __construct(
        private readonly BookService $bookService
    ) {
    }

    public function index()
    {
       # $string = $this->bookService->getAll();

        return view('home.index');
    }
}
