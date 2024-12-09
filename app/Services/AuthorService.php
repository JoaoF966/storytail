<?php

namespace App\Services;

use App\Models\Author;
use App\Storage\Repository\AuthorRepository;

readonly class AuthorService
{
    public function __construct(
        private AuthorRepository $authorRepository,
    ) {
    }

    public function storeAuthor(string $firstName, string $lastName, string $description, string $nationality): void
    {
        $author = new Author();

        $author->first_name = $firstName;
        $author->last_name = $lastName;
        $author->description = $description;
        $author->nationality = $nationality;

        $this->authorRepository->store($author);
    }
}
