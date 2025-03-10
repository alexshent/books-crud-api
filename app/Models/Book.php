<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public static function page(int $page): Paginator
    {
        return Book::query()
            ->orderBy('created_at', 'desc')
            ->with(['genres:id,name'])
            ->simplePaginate(perPage: env('APP_PAGE_SIZE'), page: $page);
    }
}
