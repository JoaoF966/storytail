<?php

namespace App\Http\Controllers;

use App\Services\BookService;

class BookController extends Controller
{
    public function __construct(private BookService $bookService)
    {

    }

    public function view($id)
    {
        $book = $this->bookService->getBookById($id);

        $thisMonthBooks = $this->bookService->getCurrentMonthBooks();

        return view('book_page',
            [
                'book' => $book,
                'thisMonthBooks' => $thisMonthBooks,
            ]);
    }

    //
    public function read(int $id)
    {
        $book = $this->bookService->getBookById($id);

        return view('book.read', [
            'book' => $book,
        ]);
    }


    public function loadPage($id, $page)
    {
        $bookFolder = public_path("images/Books/{$id}");
        $pages = $this->getPages($bookFolder);


        $currentPage = $pages[$page];
        $nextPage = $pages[$page] ?? null;

        // Configuração para exibir ou não o filme
        $showMovie = $page > 3; // Exemplo: Exibir o filme a partir da página 4
        $movieFile = 'videos/sample_movie.mp4';

        return view('book.media', [
            'bookId' => $id,
            'currentPageNumber' => $page,
            'currentPageImage' => "images/Books/{$id}/{$currentPage}",
            'nextPageImage' => $nextPage ? "images/Books/{$id}/{$nextPage}" : null,
            'totalPages' => count($pages),
            'showMovie' => $showMovie,
            'movieFile' => $movieFile,
        ]);
    }


    //AJAX para ter 2 pag sem reload
    public function ajaxLoadPage($id, $page)
    {
        $bookFolder = public_path("images/Books/{$id}");
        $pages = $this->getPages($bookFolder);

        if (!isset($pages[$page - 1])) {
            return response()->json(['error' => 'Page not found'], 404);
        }

        $currentPage = $pages[$page - 1];
        $nextPage = $pages[$page] ?? null;

        return response()->json([
            'currentPageImage' => asset("images/Books/{$id}/{$currentPage}"),
            'nextPageImage' => $nextPage ? asset("images/Books/{$id}/{$nextPage}") : null,
            'currentPageNumber' => $page,
        ]);
    }

    private function getPages($bookFolder)
    {
        return collect(scandir($bookFolder))
            ->filter(fn($file) => in_array(pathinfo($file, PATHINFO_EXTENSION), ['png', 'jpg']))
            ->values()
            ->toArray();
    }




}
