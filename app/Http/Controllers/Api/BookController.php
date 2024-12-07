<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\BookFilter;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(
        private readonly BookService $bookService,
    ) {
    }

    public function list(Request $request): JsonResponse
    {
        $bookApiFilter = BookFilter::fromRequest($request);

        return response()
            ->json(
                $this->bookService->getFilteredBooks($bookApiFilter)
            );
    }
}
