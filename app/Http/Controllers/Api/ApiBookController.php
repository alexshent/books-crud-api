<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\JsonResponse;

class ApiBookController extends Controller
{
    public function page(): JsonResponse
    {
        $page = $request['page'] ?? 1;
        $books = Book::page($page);

        return response()->json($books);
    }

    public function details(string $id): JsonResponse
    {
        $book = Book::with('genres:id,name')->find($id);

        return response()->json($book);
    }
}
