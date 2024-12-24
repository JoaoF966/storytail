<?php

namespace App\Services;

use App\Exceptions\BookNotFoundException;
use App\Http\Filters\BookFilter;
use App\Models\Book;
use App\Storage\FindsAgeGroups;
use App\Storage\FindsBooks;
use App\ValueObject\NewBookValueObject;
use Illuminate\Support\Collection;

readonly class BookService
{
    public function __construct(
        private FindsBooks $books,
        private FindsAgeGroups $ageGroups,
    ) {
    }

    /**
     * @return Collection<Book>
     */
    public function getAllBooks(): Collection
    {
        return $this->books->findAllBooks();
    }

    /**
     * @return Collection<Book>
     */
    public function getCurrentMonthBooks(): Collection
    {
        return $this->books->findCurrentMonthBooks();
    }

    /**
     * @return Collection<Book>
     */
    public function getJustAddedBooks(): Collection
    {
        return $this->books->findJustAddedBooks();
    }

    /**
     * @return Collection<Book>
     */
    public function getTopReadBooks(): Collection {
        return $this->books->findTopReadBooks();
    }

    /**
     * @return Collection<Book>
     */
    public function getFilteredBooks(BookFilter $bookFilter): Collection
    {
        return $this->books->findBooksByBookFilter($bookFilter);
    }

    public function getBookById(int $id): Book
    {
        if ($book = $this->books->findBookById($id)) {
            return $book;
        }

        throw BookNotFoundException::fromId($id);
    }

    public function storeBook(NewBookValueObject $newBookValueObject): void
    {
        $ageGroup = $this->ageGroups->findById($newBookValueObject->getAgeGroup()->getValue());

        $book = new Book();
        $book->title = $newBookValueObject->getTitle();
        $book->description = $newBookValueObject->getDescription();
        $book->age_group_id = $ageGroup->id;
        $book->read_time = $newBookValueObject->getReadTime();
        $book->access_level = $newBookValueObject->getAccessLevel()->value;
        $book->video_book_url = $newBookValueObject->getVideoBookUrl();
        $book->book_file_path = $newBookValueObject->getBookFile()->store('books', ['disk' => 'private']);
        $book->cover_url = '/app/public/' . $newBookValueObject->getCoverImage()->store('covers', ['disk' => 'public']);

        $book->save();
    }
}
