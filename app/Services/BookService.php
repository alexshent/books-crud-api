<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Book;
use Illuminate\Http\UploadedFile;

class BookService
{
    public function storeNew(Book $book, string $title, ?UploadedFile $coverFile, array $genres): void
    {
        $bookCoversDir = 'book_covers';
        $defaultCover = 'default.png';

        $coverUrl = "$bookCoversDir/$defaultCover";
        if (null !== $coverFile) {
            $coverUrl = "$bookCoversDir/" . $coverFile->hashName();
            $coverFile->move(public_path($bookCoversDir), $coverFile->hashName());
        }

        $book->title = $title;
        $book->status = 'draft';
        $book->cover_url = $coverUrl;
        $book->save();

        if (!empty($genres)) {
            $book->genres()->attach($genres);
        }

        $book->save();
    }

    public function updateExisting(Book $book, string $title, string $status, string $cover_url, array $genres): void
    {
        $book->update([
            'title' => $title,
            'status' => $status,
            'cover_url' => $cover_url,
        ]);

        if (!empty($genres)) {
            $book->genres()->detach();
            $book->genres()->attach($genres);
        }
    }

    public function publish(Book $book): void
    {
        $book->status = 'published';
        $book->save();
    }
}
