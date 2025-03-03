@extends('layout')

@section('content')

    <form action="{{ route('book.store') }}" method="POST" enctype='multipart/form-data'>
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Create new book</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm/6 font-medium text-gray-900">title</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <input type="text" name="title" id="title" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="New Book 1">
                            </div>
                        </div>
                        @error('title')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-span-full">
                        <label for="cover_file" class="block text-sm/6 font-medium text-gray-900">cover file (PNG, JPG up to 2MB)</label>
                        <input id="cover_file" name="cover_file" type="file" accept="image/png, image/jpeg" class="">
                        @error('cover_file')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-span-full">
                        <label for="genres" class="block text-sm/6 font-medium text-gray-900">genres</label>
                        <select name="genres[]" multiple>
                        @forelse ($genres as $genre)
                                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                        @empty
                                <option value="">no genres available</option>
                        @endforelse
                        </select>
                        @error('genres')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a type="button" class="text-sm/6 font-semibold text-gray-900" href="{{ route('book.index') }}">Cancel</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>

@endsection
