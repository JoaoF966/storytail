<?php

namespace App\Storage\Repository;

use App\Http\Filters\BookFilter;
use App\Models\Book;
use App\Storage\FindsBooks;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BookRepository implements FindsBooks
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

    /**
     * @return Collection<Book>
     */
    public function findBooksByBookFilter(BookFilter $bookFilter): Collection {
        $queryBuilder = Book::query();

        if ($bookFilter->search) {
            $queryBuilder->where('title', 'LIKE', "%{$bookFilter->search}%");

            $queryBuilder->orWhereHas('authors', function ($query) use ($bookFilter) {
                $query->where('first_name', 'LIKE', "%{$bookFilter->search}%")
                    ->orWhere('last_name', 'LIKE', "%{$bookFilter->search}%");
            });
        }

       return $queryBuilder
           ->paginate(perPage: 15, page: $bookFilter->page)
           ->getCollection();
    }

    public function findBookById(int $id): ?Book
    {
        return Book::with('authors')
            ->find($id);
    }
}
