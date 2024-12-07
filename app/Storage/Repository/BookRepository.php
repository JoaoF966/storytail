<?php

namespace App\Storage\Repository;

use App\Models\Book;
use App\Storage\FindBooks;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BookRepository implements FindBooks
{
    /**
     * @return Collection<Book>
     */
    public function findAllBooks(): Collection
    {
        return Book::all();
    }

    /**
     * @return Collection<Book>
     */
    public function findCurrentMonthBooks(): Collection
    {
        return Book::where('featured_at', '>=', now()->startOfMonth())->get();
    }

    /**
     * @return Collection<Book>
     */
    public function findJustAddedBooks(): Collection
    {
        return Book::orderBy('created_at', 'desc')->take(10)->get();
    }

    /**
     * @return Collection<Book>
     */
    public function findTopReadBooks(): Collection
    {
        return Book::select(
            'books.*',
            DB::raw('COUNT(book_user_read.user_id) AS times_read')
        )
            ->join('book_user_read', 'book_user_read.book_id', '=', 'books.id')
            ->where('book_user_read.read_date', '>=', now()->subMonths(3))
            ->groupBy('books.id', 'books.title')
            ->orderBy('times_read', 'desc')
            ->get();
    }
}
