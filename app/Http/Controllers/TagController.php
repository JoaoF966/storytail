<?php

namespace App\Http\Controllers;

use App\Services\TagService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TagController extends Controller
{
    public function __construct(
        private readonly TagService $tagService,
    ) {
    }

    public function index(): View
    {
        $tags = $this->tagService->getAllTags();
        return view('tag.index', [
            'tags' => $tags,
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validateWithBag('tagCreation', [
            'name' => ['required', 'string', 'max:255', 'alpha_dash'],
        ]);

        $this->tagService->storeTag($request->get('name'));

        return redirect()->route('tag.index')->with('status', __('Tag created successfully.'));
    }
}
