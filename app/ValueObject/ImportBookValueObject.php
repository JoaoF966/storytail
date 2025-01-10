<?php

declare(strict_types=1);

namespace App\ValueObject;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ImportBookValueObject
{
    private function __construct(
        public readonly Identifier $bookId,
        public readonly bool $isFirstPageCover,
        public readonly UploadedFile | null $bookFile,
        public readonly UploadedFile | null $coverImage,
    ) {
        if (null !== $this->bookFile && (!$this->bookFile->isValid() || !$this->bookFile->isReadable())) {
            throw new \InvalidArgumentException('Invalid book file');
        }

        if (null !== $this->coverImage && (!$this->coverImage->isValid() || !$this->coverImage->isReadable())) {
            throw new \InvalidArgumentException('Invalid cover image');
        }
    }

    public static function fromRequest(Request $request, Identifier $bookId): self
    {
        return new self(
            $bookId,
            $request->get('is_first_page_cover', '0') !== '0',
            $request->file('book_file'),
            $request->file('cover_image')
        );
    }


    public function getBookFile(): UploadedFile | null
    {
        return $this->bookFile;
    }

    public function getCoverImage(): UploadedFile | null
    {
        return $this->coverImage;
    }

    public function isFirstPageCover(): bool
    {
        return $this->isFirstPageCover;
    }

    public function getBookId(): Identifier {
        return $this->bookId;
    }
}
