<?php

namespace App\Services;

use App\Exceptions\BookNotFoundException;
use App\Http\Filters\BookFilter;
use App\Models\Book;
use App\Storage\FindsAgeGroups;
use App\Storage\FindsBooks;
use App\Storage\StoresBook;
use App\ValueObject\BookValueObject;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

readonly class BookService
{
    public function __construct(
        private FindsBooks $books,
        private StoresBook $store,
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
    public function getTopReadBooks(): Collection
    {
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

    public function storeBook(BookValueObject $newBookValueObject): void
    {
        $ageGroup = $this->ageGroups->findById($newBookValueObject->getAgeGroup()->getValue());

        $book = new Book();
        $book->title = $newBookValueObject->getTitle();
        $book->description = $newBookValueObject->getDescription();
        $book->age_group_id = $ageGroup->id;
        $book->read_time = $newBookValueObject->getReadTime();
        $book->access_level = $newBookValueObject->getAccessLevel()->value;
        $book->video_book_url = $newBookValueObject->getVideoBookUrl();

        if ($newBookValueObject->getBookFile()) {
            $book->book_file_path = $newBookValueObject->getBookFile()->store('books', ['disk' => 'private']);
        }

        if ($newBookValueObject->getCoverImage()) {
            $book->cover_url = '/app/public/' . $newBookValueObject->getCoverImage()->store('covers', ['disk' => 'public']);
        }

        $this->store->store($book);
    }

    public function updateBook(int $id, BookValueObject $updatedBookValueObject): void
    {
        $book = $this->getBookById($id);

        if ($book->age_group_id !== $updatedBookValueObject->getAgeGroup()->getValue()) {
            $ageGroup = $this->ageGroups->findById($updatedBookValueObject->getAgeGroup()->getValue());
            $ageGroupId = $ageGroup->id;
        } else {
            $ageGroupId = $book->age_group_id;
        }

        $book->title = $updatedBookValueObject->getTitle();
        $book->description = $updatedBookValueObject->getDescription();
        $book->age_group_id = $ageGroupId;
        $book->read_time = $updatedBookValueObject->getReadTime();
        $book->access_level = $updatedBookValueObject->getAccessLevel()->value;
        $book->video_book_url = $updatedBookValueObject->getVideoBookUrl();

        if ($updatedBookValueObject->getBookFile()) {
            if ($book->book_file_path) {
                Storage::disk('private')->delete($book->book_file_path);
            }
            $book->book_file_path = $updatedBookValueObject->getBookFile()->store('books', ['disk' => 'private']);
        }

        if ($updatedBookValueObject->getCoverImage()) {
            if ($book->cover_url) {
                Storage::disk('public')->delete(str_replace('/app/public/', '', $book->cover_url));
            }
            $book->cover_url = '/app/public/' . $updatedBookValueObject->getCoverImage()->store('covers', ['disk' => 'public']);
        }

        $this->store->store($book);
    }

    public function deleteBook(int $id): void
    {
        $book = $this->getBookById($id);

        $this->store->delete($book);
    }
}
