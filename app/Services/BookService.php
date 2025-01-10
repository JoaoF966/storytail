<?php

namespace App\Services;

use App\Exceptions\BookNotFoundException;
use App\Exceptions\EmptyBookFileException;
use App\Http\Filters\BookFilter;
use App\Models\Book;
use App\Models\Page;
use App\Storage\FindsAgeGroups;
use App\Storage\FindsBooks;
use App\Storage\StoresBook;
use App\ValueObject\BookValueObject;
use App\ValueObject\ImportBookValueObject;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Imagick;

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

    public function generatePagesFromUploadedPdf(ImportBookValueObject $importBookValueObject): Book
    {
        $book = $this->getBookById($importBookValueObject->getBookId()->getValue());

        $currentBookFilePath = $book->book_file_path;

        $book->book_file_path = $importBookValueObject
            ->getBookFile()
            ->store(
                sprintf('books/%s', $book->id),
                ['disk' => 'private']
            );

        if ($importBookValueObject->getCoverImage() && !$importBookValueObject->isFirstPageCover) {
            $book->cover_url = '/app/public/' . $importBookValueObject->getCoverImage()->store('covers', ['disk' => 'public']);
        }

        $imagick = new Imagick();
        $imagick->setResolution(300, 300); // 300 DPI for high quality
        $imagick->readImage(Storage::disk('private')->path($book->book_file_path));

        $publicPath = Storage::disk('public')->path('');

        if (!is_dir($publicPath . sprintf('books/%s', $book->id))) {
            mkdir($publicPath . sprintf('books/%s', $book->id), 0777, true);
        } else {
            foreach (glob($publicPath . sprintf('books/%s/page_*', $book->id)) as $file) {
                unlink($file);
            }
        }

        $bookPages = [];

        if ($imagick->count() < 1) {
            throw EmptyBookFileException::fromBookFilename(
                $importBookValueObject
                    ->getBookFile()
                    ->getFilename()
            );
        }

        if ($currentBookFilePath) {
            Storage::disk('private')->delete($currentBookFilePath);
        }

        foreach ($imagick as $pageNumber => $pdfPage) {
            $pdfPage->setImageFormat('jpg');
            $pdfPage->writeImage($publicPath . sprintf('books/%s/page_%s.jpg', $book->id, $pageNumber + 1));

            $page = new Page();

            $page->book_id = $book->id;
            $page->page_index = $pageNumber + 1;
            $page->page_image_url = sprintf('/app/public/books/%s/page_%s.jpg', $book->id, $pageNumber + 1);

            if ($importBookValueObject->isFirstPageCover && $pageNumber === 0) {
                $book->cover_url = $page->page_image_url;
            }

            $bookPages[] = $page;
        }

        $imagick->clear();
        $imagick->destroy();

        $this->store->deletePages($book);
        $this->store->storePages($book, $bookPages);
        $this->store->store($book);

        return $book->refresh();
    }
}
