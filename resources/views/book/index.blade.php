@extends('layout')

@section('content')

@if(session('success'))
    <div class="w-full relative isolate flex items-center gap-x-6 overflow-hidden bg-gray-50 px-6 py-2.5 sm:px-3.5 sm:before:flex-1" id="success-message">
        <div class="absolute top-1/2 left-[max(-7rem,calc(50%-52rem))] -z-10 -translate-y-1/2 transform-gpu blur-2xl" aria-hidden="true">
            <div class="aspect-577/310 w-[36.0625rem] bg-linear-to-r from-[#ff80b5] to-[#9089fc] opacity-30" style="clip-path: polygon(74.8% 41.9%, 97.2% 73.2%, 100% 34.9%, 92.5% 0.4%, 87.5% 0%, 75% 28.6%, 58.5% 54.6%, 50.1% 56.8%, 46.9% 44%, 48.3% 17.4%, 24.7% 53.9%, 0% 27.9%, 11.9% 74.2%, 24.9% 54.1%, 68.6% 100%, 74.8% 41.9%)"></div>
        </div>
        <div class="absolute top-1/2 left-[max(45rem,calc(50%+8rem))] -z-10 -translate-y-1/2 transform-gpu blur-2xl" aria-hidden="true">
            <div class="aspect-577/310 w-[36.0625rem] bg-linear-to-r from-[#ff80b5] to-[#9089fc] opacity-30" style="clip-path: polygon(74.8% 41.9%, 97.2% 73.2%, 100% 34.9%, 92.5% 0.4%, 87.5% 0%, 75% 28.6%, 58.5% 54.6%, 50.1% 56.8%, 46.9% 44%, 48.3% 17.4%, 24.7% 53.9%, 0% 27.9%, 11.9% 74.2%, 24.9% 54.1%, 68.6% 100%, 74.8% 41.9%)"></div>
        </div>
        <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
            <p class="text-sm/6 text-gray-900">
                {{ session('success') }}
            </p>
        </div>
        <div class="flex flex-1 justify-end">
            <button type="button" class="-m-3 p-3 focus-visible:outline-offset-[-4px]" onclick="document.getElementById('success-message').remove()">
                <span class="sr-only">Dismiss</span>
                <svg class="size-5 text-gray-900" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                    <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                </svg>
            </button>
        </div>
    </div>
@endif

    <div class="w-full">
        <a type="button" class="rounded-md px-2 py-2 bg-amber-400 text-sm/6 font-semibold text-gray-900" href="{{ route('main') }}">Back</a>
        <a type="button" class="mb-5 float-end bg-blue-500 rounded-md px-2 py-2 text-sm font-semibold text-gray-900" href="{{ route('book.create') }}">Create new</a>
    </div>

    <div class="basis-full h-0"></div>

    <div class="w-full text-sm">
    <table class="table border-collapse border border-gray-400 mt-5 mb-5">
        <thead>
        <tr>
            <th class="border border-gray-300">id</th>
            <th class="border border-gray-300">title</th>
            <th class="border border-gray-300">status</th>
            <th class="border border-gray-300">cover_url</th>
            <th class="border border-gray-300">genres</th>
            <th class="border border-gray-300">created at</th>
            <th class="border border-gray-300">updated at</th>
            <th class="border border-gray-300">action</th>
        </tr>
        </thead>

        <tbody>
        @forelse ($books as $book)
            <tr>
                <td class="border border-gray-300">{{ $book->id }}</td>
                <td class="border border-gray-300">{{ $book->title }}</td>
                <td class="border border-gray-300">{{ $book->status }}</td>
                <td class="border border-gray-300">
                    {{ $book->cover_url }}
                    <br>
                    <img src="{{ $book->cover_url }}" alt="" class="max-h-50">
                </td>
                <td class="border border-gray-300">
                    @forelse ($book->genres as $genre)
                        {{ $genre->name }}
                    @empty
                        no genre assigned
                    @endforelse
                </td>
                <td class="border border-gray-300">{{ $book->created_at }}</td>
                <td class="border border-gray-300">{{ $book->updated_at }}</td>
                <td class="border border-gray-300">
                    <a type="button" class="px-1 text-sm bg-green-500 rounded-md" href="{{ route('book.show', $book->id) }}">Show</a>
                    <br>
                    <a type="button" class="px-1 text-sm bg-orange-500 rounded-md" href="{{ route('book.edit', $book->id) }}">Edit</a>
                    <form action="{{ route('book.destroy', $book->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="cursor-pointer px-1 text-sm bg-red-500 rounded-md">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td>no data</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    </div>

    <div class="basis-full h-0"></div>

    <div class="w-full">
        {{ $books->links() }}
    </div>

@endsection
