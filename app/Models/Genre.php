<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    /** @use HasFactory<\Database\Factories\GenreFactory> */
    use HasFactory;
    use HasUuids;

    protected $fillable = ['name'];
    protected $hidden = ['pivot'];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }

    public static function page(int $page): Paginator
    {
        return Genre::query()
            ->orderBy('created_at', 'desc')
            ->simplePaginate(perPage: env('APP_PAGE_SIZE'), page: $page);
    }

    public function booksPage(int $page): Paginator
    {
        return $this->books()
            ->orderBy('created_at', 'desc')
            ->simplePaginate(perPage: env('APP_API_PAGE_SIZE'), page: $page);
    }
}
