<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\BookNotFoundException;
use App\Exceptions\EmptyBookFileException;
use App\Services\AgeGroupService;
use App\Services\BookService;
use App\Services\TagService;
use App\ValueObject\BookValueObject;
use App\ValueObject\Identifier;
use App\ValueObject\ImportBookValueObject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookController
{
    public function __construct(
        private readonly BookService $bookService,
        private readonly AgeGroupService $ageGroupService,
        private readonly TagService $tagService,
    ) {
    }

    public function index() {
        $books = $this->bookService->getAllBooks();
        $ageGroups = $this->ageGroupService->getAllAgeGroups();
        $tags = $this->tagService->getAllTags();

        return view('admin.book.index', [
            'books' => $books,
            'ageGroups' => $ageGroups,
            'tags' => $tags,
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'age_group' => ['required', 'integer', 'exists:age_groups,id'],
            'read_time' => ['required', 'integer', 'min:1'],
            'access_level' => ['required', 'string', 'max:255', 'in:free,premium'],
            'video_book_url' => ['url', 'nullable'],
            'tags' => ['array'],
        ]);

        $request->validate([
            'cover_image' => ['file', 'mimes:jpeg,png,jpg'],
        ]);

        $this->bookService->storeBook(BookValueObject::fromRequest($request));

        return redirect()->route('admin.book.index')
            ->with('status', __('Book created successfully.'))
            ->with('type', 'success');
    }

    public function edit(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'age_group' => ['required', 'integer', 'exists:age_groups,id'],
            'read_time' => ['required', 'integer', 'min:1'],
            'access_level' => ['required', 'string', 'max:255', 'in:free,premium'],
            'video_book_url' => ['url', 'nullable'],
        ]);

        $request->validate([
            'book_file' => ['file', 'mimes:pdf'],
            'cover_image' => ['file', 'mimes:jpeg,png,jpg'],
        ]);

        $this->bookService->updateBook($id, BookValueObject::fromRequest($request));

        return redirect()->route('admin.book.index')
            ->with('status', __('Book updated successfully.'))
            ->with('type', 'success');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->bookService->deleteBook($id);

        return redirect()->route('admin.book.index')
            ->with('status', __('Book deleted successfully.'))
            ->with('type', 'success');
    }

    public function import(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'book_file' => ['required', 'file', 'mimes:pdf'],
            'cover_image' => ['file', 'mimes:jpeg,png,jpg'],
        ]);

        try {
            $book = $this->bookService->generatePagesFromUploadedPdf(
                ImportBookValueObject::fromRequest(
                    $request,
                    Identifier::fromInt($id)
                )
            );

            $responseData = ['pages' => []];

            foreach ($book->pages as $page) {
                $responseData['pages'][] = [
                    'id' => $page->id,
                    'page_index' => $page->page_index,
                    'page_image_url' => $page->page_image_url,
                ];
            }

            return response()
                ->json($responseData)
                ->setStatusCode(201);
        } catch (EmptyBookFileException | BookNotFoundException $e) {
            return response()
                ->json(['message' => $e->getMessage()])
                ->setStatusCode($e->getStatusCode());
        }
    }
}
