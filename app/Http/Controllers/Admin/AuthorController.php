<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AuthorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthorController extends Controller
{
    public function __construct(
        private readonly AuthorService $authorService,
    ) {
    }

    public function index(): View
    {
        $authors = $this->authorService->getAllAuthors();

        return view('admin.author.index', ['authors' => $authors]);
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'nationality' => ['required', 'string', 'max:255'],
        ]);

        $this->authorService->storeAuthor(
            $request->get('first_name'),
            $request->get('last_name'),
            $request->get('description'),
            $request->get('nationality'),
        );

        return redirect()->route('admin.author.index')->with('status', __('Author created successfully.'));
    }

    public function edit(Request $request, int $id): RedirectResponse
    {
       $request->validate([
            'first_name' => ['required','string','max:255'],
            'last_name' => ['required','string','max:255'],
            'description' => ['required','string','max:255'],
            'nationality' => ['required','string','max:255'],
       ]);

       $this->authorService->updateAuthor(
           $id,
           $request->get('first_name'),
           $request->get('last_name'),
           $request->get('description'),
           $request->get('nationality'),
       );

        return redirect()->route('admin.author.index')->with('status', __('Author updated successfully.'));
    }

    public function destroy(int $id): RedirectResponse {
        $this->authorService->deleteAuthor($id);
        return redirect()->route('admin.author.index')->with('status', __('Author deleted successfully.'));
    }
}
