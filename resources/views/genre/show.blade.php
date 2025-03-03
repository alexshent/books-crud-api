@extends('layout')

@section('content')

    <div class="w-full">
        <a type="button" class="px-3 py-2 text-sm font-semibold text-gray-900 bg-green-500 rounded-md" href="{{ route('genre.index') }}">Back</a>
    </div>

    <div class="basis-full h-0"></div>

    <div class="w-full">
    <table class="table mt-5 mb-5">
        <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>created at</th>
            <th>updated at</th>
        </tr>
        </thead>

        <tbody>
            <tr>
                <td>{{ $genre->id  }}</td>
                <td>{{ $genre->name  }}</td>
                <td>{{ $genre->created_at  }}</td>
                <td>{{ $genre->updated_at  }}</td>
            </tr>
        </tbody>
    </table>
    </div>

@endsection
