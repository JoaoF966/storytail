<?php

namespace App\ValueObject;

use App\AccessLevel;
use Illuminate\Http\Request;

class BookValueObject
{
    private function __construct(
        private readonly string $title,
        private readonly string $description,
        private readonly Identifier $ageGroupId,
        private readonly int $readTime,
        private readonly AccessLevel $accessLevel,
        private readonly string|null $videoBookUrl,
        private readonly array $tags,
        private readonly array $authors,
    ) {
        if (!$this->title) {
            throw new \InvalidArgumentException('Title is required');
        }

        if (!$this->description) {
            throw new \InvalidArgumentException('Description is required');
        }

        if ($this->readTime < 1) {
            throw new \InvalidArgumentException('Read time must be a positive integer');
        }

        if ($this->videoBookUrl && !filter_var($this->videoBookUrl, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Invalid video book URL');
        }
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->get('title'),
            $request->get('description'),
            Identifier::fromInt((int)$request->get('age_group')),
            $request->get('read_time'),
            AccessLevel::from($request->get('access_level')),
            $request->get('video_book_url'),
            $request->get('tags', []),
            $request->get('authors', [])
        );
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAgeGroup(): Identifier
    {
        return $this->ageGroupId;
    }

    public function getReadTime(): int
    {
        return $this->readTime;
    }

    public function getAccessLevel(): AccessLevel
    {
        return $this->accessLevel;
    }

    public function getVideoBookUrl(): ?string
    {
        return $this->videoBookUrl;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function getAuthors(): array
    {
        return $this->authors;
    }
}
