@extends('layout')

@section('content')

    <div class="w-full">
        <a type="button" class="px-3 py-2 text-sm font-semibold text-gray-900 bg-green-500 rounded-md" href="{{ route('book.index') }}">Back</a>
    </div>

    <div class="basis-full h-0"></div>

    <div class="w-full text-sm">
    <table class="table mt-5 mb-5">
        <thead>
        <tr>
            <th>id</th>
            <th>title</th>
            <th>status</th>
            <th>cover</th>
            <th>genres</th>
            <th>created at</th>
            <th>updated at</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td>{{ $book->id }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->status }}</td>
            <td>{{ $book->cover_url }}</td>
            <td>
                @forelse ($book->genres as $genre)
                    {{ $genre->name }}
                @empty
                    no genre assigned
                @endforelse
            </td>
            <td>{{ $book->created_at }}</td>
            <td>{{ $book->updated_at }}</td>
        </tr>
        </tbody>
    </table>
    </div>

@endsection
