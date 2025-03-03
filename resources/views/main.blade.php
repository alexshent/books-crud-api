@extends('layout')

@section('content')

    <div class="text-lg">
        <p class="text-blue-400">
        <a href="{{ route('genre.index') }}">Genres</a>
        </p>

        <p class="text-green-400">
        <a href="{{ route('book.index') }}">Books</a>
        </p>
    </div>

@endsection
