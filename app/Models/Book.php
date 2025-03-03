<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\UploadedFile;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;
    use HasUuids;

    protected $fillable = ['title', 'status', 'cover_url'];
    protected $hidden = ['pivot'];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function genresIds(): array
    {
        return $this->genres()->pluck('id')->toArray();
    }

    public function storeNew(string $title, ?UploadedFile $coverFile, array $genres): void
    {
        $bookCoversDir = 'book_covers';
        $defaultCover = 'default.png';

        $coverUrl = "$bookCoversDir/$defaultCover";
        if (null !== $coverFile) {
            $coverUrl = "$bookCoversDir/" . $coverFile->hashName();
            $coverFile->move(public_path($bookCoversDir), $coverFile->hashName());
        }

        $this->title = $title;
        $this->status = 'draft';
        $this->cover_url = $coverUrl;
        $this->save();

        if (!empty($genres)) {
            $this->genres()->attach($genres);
        }

        $this->save();
    }

    public function updateExisting(string $title, string $status, string $cover_url, array $genres): void
    {
        $this->update([
            'title' => $title,
            'status' => $status,
            'cover_url' => $cover_url,
        ]);

        if (!empty($genres)) {
            $this->genres()->detach();
            $this->genres()->attach($genres);
        }
    }

    public function publish(): void
    {
        $this->status = 'published';
        $this->save();
    }

    public static function page(int $page): Paginator
    {
        return Book::query()
            ->orderBy('created_at', 'desc')
            ->with(['genres:id,name'])
            ->simplePaginate(perPage: env('APP_PAGE_SIZE'), page: $page);
    }
}
