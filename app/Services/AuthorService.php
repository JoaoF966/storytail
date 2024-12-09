<?php

namespace App\Services;

use App\Exceptions\AuthorNotFoundException;
use App\Models\Author;
use App\Storage\FindsAuthor;
use App\Storage\StoresAuthor;
use Illuminate\Support\Collection;

readonly class AuthorService
{
    public function __construct(
        private FindsAuthor  $authors,
        private StoresAuthor $store,
    ) {
    }

    public function storeAuthor(string $firstName, string $lastName, string $description, string $nationality): void
    {
        $author = new Author();

        $author->first_name = $firstName;
        $author->last_name = $lastName;
        $author->description = $description;
        $author->nationality = $nationality;
        $author->author_photo_url = sprintf('/images/author/%s.jpg', rand(1, 8));

        $this->store->store($author);
    }

    /**
     * @return Collection<Author>
     */
    public function getAllAuthors(): Collection
    {
        return $this->authors->getAllAuthors();
    }

    public function updateAuthor(int $id, string $firstName, string $lastName, string $description, string $nationality): void
    {
        $author = $this->authors->findById($id);

        if ($author === null) {
            throw AuthorNotFoundException::fromId($id);
        }

        $author->first_name = $firstName;
        $author->last_name = $lastName;
        $author->description = $description;
        $author->nationality = $nationality;

        $this->store->store($author);
    }

    private function findAuthorById(int $id): Author
    {
        if ($author = $this->authors->findById($id)) {
            return $author;
        }

        throw AuthorNotFoundException::fromId($id);
    }
}
