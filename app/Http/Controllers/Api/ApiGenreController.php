<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiGenreController extends Controller
{
    public function all(): JsonResponse
    {
        $genres = Genre::all();

        return response()->json($genres);
    }

    public function genreBooks(Request $request, string $id): JsonResponse
    {
        $genre = Genre::find($id);
        $page = $request['page'] ?? 1;
        $books = $genre->booksPage($page);

        return response()->json($books);
    }
}
