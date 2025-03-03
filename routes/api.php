<?php

use App\Http\Controllers\Api\ApiBookController;
use App\Http\Controllers\Api\ApiGenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/genres', [ApiGenreController::class, 'all'])->name('api.genre.all');

Route::get('/genres/{id}', [ApiGenreController::class, 'genreBooks'])
    ->whereUuid('id')
    ->name('api.genre.books');

Route::get('/books', [ApiBookController::class, 'page'])->name('api.book.page');

Route::get('/books/{id}', [ApiBookController::class, 'details'])
    ->whereUuid('id')
    ->name('api.book.details');
