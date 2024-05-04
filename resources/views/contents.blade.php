@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @php
            $heading = 'All Content'; // Default heading

            if (request()->has('search')) {
                $heading = 'Search results for "' . request('search') . '"';
            } elseif (request()->has('genre')) {
                $heading = 'Filtered by Genre';
            } elseif (request('type') == 'movie') {
                $heading = 'Movies';
            } elseif (request('type') == 'tv_show') {
                $heading = 'TV Shows';
            }
        @endphp

        <h1 class="text-2xl font-bold mt-6">{{ $heading }}</h1>
        <form action="{{ route('contents') }}" method="GET">
            <div>
                <h6 class="font-semibold">Genre</h6>
                @foreach ($genres as $genre)
                    <div class="inline-flex items-center mr-2">
                        <input class="form-checkbox h-5 w-5 text-blue-600" type="checkbox" name="genre[]" value="{{ $genre->name }}"
                            id="genre_{{ $genre->id }}"
                            {{ is_array(request('genre')) && in_array($genre->name, request('genre')) ? 'checked' : '' }}>
                        <label class="ml-2 text-gray-700" for="genre_{{ $genre->id }}">
                            {{ $genre->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="mt-3">
                <h6 class="font-semibold">Movie or TV Show</h6>
                @foreach ($types as $type)
                    <div class="inline-flex items-center mr-2">
                        <input class="form-radio h-5 w-5 text-blue-600" type="radio" name="type" value="{{ $type->type }}"
                            id="type_{{ $type->type }}" {{ request('type') == $type->type ? 'checked' : '' }}>
                        <label class="ml-2 text-gray-700"
                            for="type_{{ $type->type }}">{{ ucfirst(str_replace('_', ' ', $type->type)) }}</label>
                    </div>
                @endforeach
            </div>

            <div class="flex mt-3">
                <div class="mr-4">
                    <label for="release_date_from" class="form-label inline-block mb-2 text-gray-700">Release Date From:</label>
                    <input type="date" id="release_date_from" name="release_date_from" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        value="{{ request('release_date_from') }}">
                </div>

                <div>
                    <label for="release_date_to" class="form-label inline-block mb-2 text-gray-700">Release Date To:</label>
                    <input type="date" id="release_date_to" name="release_date_to" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        value="{{ request('release_date_to') }}">
                </div>
            </div>
            <div class="mt-3 flex space-x-2">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-bold rounded hover:bg-blue-700">Filter</button>
                @if (request()->except('page'))
                    <a href="{{ route('contents') }}" class="px-4 py-2 bg-red-500 text-white font-bold rounded hover:bg-red-700">Reset</a>
                @endif
            </div>
        </form>

        @if ($contents->isNotEmpty())
            <div class="grid grid-cols-4 gap-4 mt-5">
                @foreach ($contents as $content)
                    <x-content-card :title="$content->title" :photo-url="$content->photo_url" :release-date="$content->release_date" :average-rating="$content->averageRating"
                        :id="$content->id" class="h-full" />
                @endforeach
            </div>
            <div class="mt-4 flex justify-center">
                {{ $contents->links('vendor.pagination.tailwind') }} {{-- Ensure you have a Tailwind styled pagination --}}
            </div>
        @else
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mt-3" role="alert">
                No results found. Please try a different search term or filter.
            </div>
        @endif
    </div>
@endsection
