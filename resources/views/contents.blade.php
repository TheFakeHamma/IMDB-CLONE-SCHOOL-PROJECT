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

        <h1 class="text-4xl text-[#FFFFFF] font-bold mt-20 mb-10">{{ $heading }}</h1>
        <form action="{{ route('contents') }}" method="GET" class="bg-[#3F444A] p-6 rounded-lg shadow-lg">
            <div class="space-y-4">
                <div>
                    <h6 class="font-semibold text-lg text-white">Genre</h6>
                    <div class="flex flex-wrap">
                        @foreach ($genres as $genre)
                            <div class="mr-4 mb-2">
                                <input class="form-checkbox rounded text-blue-600 focus:ring-blue-500" type="checkbox"
                                    name="genre[]" value="{{ $genre->name }}" id="genre_{{ $genre->id }}"
                                    {{ is_array(request('genre')) && in_array($genre->name, request('genre')) ? 'checked' : '' }}>
                                <label for="genre_{{ $genre->id }}" class="ml-2 text-white">
                                    {{ $genre->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h6 class="font-semibold text-lg text-white">Movie or TV Show</h6>
                    <div class="flex">
                        @foreach ($types as $type)
                            <div class="mr-4">
                                <input class="form-radio h-5 w-5 text-blue-600 focus:ring-blue-500" type="radio"
                                    name="type" value="{{ $type->type }}" id="type_{{ $type->type }}"
                                    {{ request('type') == $type->type ? 'checked' : '' }}>
                                <label for="type_{{ $type->type }}" class="ml-2 text-white">
                                    {{ ucfirst(str_replace('_', ' ', $type->type)) }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex gap-4">
                    <div>
                        <label for="release_date_from" class="font-semibold text-white">Release Date From:</label>
                        <input type="date" id="release_date_from" name="release_date_from"
                            class="form-input mt-1 block w-full rounded-md shadow-sm"
                            value="{{ request('release_date_from') }}">
                    </div>
                    <div>
                        <label for="release_date_to" class="font-semibold text-white">Release Date To:</label>
                        <input type="date" id="release_date_to" name="release_date_to"
                            class="form-input mt-1 block w-full rounded-md shadow-sm"
                            value="{{ request('release_date_to') }}">
                    </div>
                </div>
                <div class="flex space-x-2">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white font-bold rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Filter</button>
                    @if (request()->except('page'))
                        <a href="{{ route('contents') }}"
                            class="px-4 py-2 bg-red-500 text-white font-bold rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Reset</a>
                    @endif
                </div>
            </div>
        </form>


        @if ($contents->isNotEmpty())
            <div class="grid grid-cols-4 gap-4 mt-10">
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
