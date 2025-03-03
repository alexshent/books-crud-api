<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::factory()
            ->count(10)
            ->create();

        $genres = Genre::all();

        Book::all()->each(function (Book $book) use ($genres) {
            $book->genres()->attach($genres->random(1));
        });
    }
}
