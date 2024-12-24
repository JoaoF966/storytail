<?php

namespace App\Http\Controllers\Admin;

use App\Services\AgeGroupService;
use App\Services\BookService;
use App\ValueObject\NewBookValueObject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookController
{
    public function __construct(
        private readonly BookService $bookService,
        private readonly AgeGroupService $ageGroupService,
    ) {
    }

    public function index() {
        $books = $this->bookService->getAllBooks();
        $ageGroups = $this->ageGroupService->getAllAgeGroups();

        return view('admin.book.index', [
            'books' => $books,
            'ageGroups' => $ageGroups,
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
            'video_book_url' => ['url'],
        ]);

        $request->validate([
            'book_file' => ['file', 'mimes:pdf'],
            'cover_image' => ['file', 'mimes:jpeg,png,jpg'],
        ]);

        $this->bookService->storeBook(NewBookValueObject::fromRequest($request));

        return redirect()->route('admin.book.index')->with('status', __('Book created successfully.'));
    }
}
