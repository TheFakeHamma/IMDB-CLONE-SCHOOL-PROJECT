@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20">
    <h1 class="text-4xl text-white font-bold mb-10">Your Watchlist</h1>
    
    <form action="{{ route('watchlist') }}" method="GET" class="bg-gray-800 p-6 rounded-lg shadow-lg mb-10">
        <div class="space-y-4">
            <div>
                <h6 class="font-semibold text-lg text-white">Genre</h6>
                <div class="flex flex-wrap">
                    @foreach ($genres as $genre)
                        <div class="mr-4 mb-2">
                            <input class="rounded text-blue-600 focus:ring-blue-500" type="checkbox"
                                name="genres[]" value="{{ $genre->id }}" id="genre_{{ $genre->id }}"
                                {{ in_array($genre->id, request('genres', [])) ? 'checked' : '' }}>
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
                            <input class="h-5 w-5 text-blue-600 focus:ring-blue-500" type="radio"
                                name="type" value="{{ $type }}" id="type_{{ $type }}"
                                {{ request('type') == $type ? 'checked' : '' }}>
                            <label for="type_{{ $type }}" class="ml-2 text-white">
                                {{ ucfirst($type) }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex gap-4">
                <div>
                    <label for="release_date_from" class="font-semibold text-white">Release Date From:</label>
                    <input type="date" id="release_date_from" name="release_date_from"
                        class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        value="{{ request('release_date_from') }}">
                </div>
                <div>
                    <label for="release_date_to" class="font-semibold text-white">Release Date To:</label>
                    <input type="date" id="release_date_to" name="release_date_to"
                        class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        value="{{ request('release_date_to') }}">
                </div>
            </div>

            <div>
                <h6 class="font-semibold text-lg text-white">Watch Status</h6>
                <div class="flex">
                    <div class="mr-4">
                        <input class="h-5 w-5 text-blue-600 focus:ring-blue-500" type="radio" name="watched_status" value="all" id="watched_status_all"
                            {{ request('watched_status') == 'all' ? 'checked' : '' }}>
                        <label for="watched_status_all" class="ml-2 text-white">All</label>
                    </div>
                    <div class="mr-4">
                        <input class="h-5 w-5 text-blue-600 focus:ring-blue-500" type="radio" name="watched_status" value="watched"
                            id="watched_status_watched" {{ request('watched_status') == 'watched' ? 'checked' : '' }}>
                        <label for="watched_status_watched" class="ml-2 text-white">Watched</label>
                    </div>
                    <div>
                        <input class="h-5 w-5 text-blue-600 focus:ring-blue-500" type="radio" name="watched_status" value="not_watched"
                            id="watched_status_not_watched" {{ request('watched_status') == 'not_watched' ? 'checked' : '' }}>
                        <label for="watched_status_not_watched" class="ml-2 text-white">Not Watched</label>
                    </div>
                </div>
            </div>

            <div class="flex space-x-2">
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white font-bold rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Filter</button>
                @if (request()->except('page'))
                    <a href="{{ route('watchlist') }}"
                        class="px-4 py-2 bg-red-500 text-white font-bold rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Reset</a>
                @endif
            </div>
        </div>
    </form>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mt-3" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if ($watchlistItems->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($watchlistItems as $item)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col justify-between">
                    <div>
                        <img class="w-full h-48 object-cover" src="{{ $item->content->photo_url }}" alt="{{ $item->content->title }}">
                        <div class="p-4">
                            <h5 class="text-xl font-bold">{{ $item->content->title }}</h5>
                            <p class="text-gray-700">Release date: {{ $item->content->release_date->format('Y') }}</p>
                        </div>
                    </div>
                    <div class="p-4 flex flex-col space-y-2">
                        @if (!$item->watched)
                            <form action="{{ route('watchlist.watched', $item->content_id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Mark as Watched</button>
                            </form>
                        @else
                            <form action="{{ route('watchlist.not-watched', $item->content_id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Unmark as Watched</button>
                            </form>
                        @endif
                        <a href="{{ route('content.show', ['id' => $item->content_id]) }}"
                            class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">Go to Movie</a>
                        <form action="{{ route('watchlist.remove', $item->content_id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Remove</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4 flex justify-center">
            {{ $watchlistItems->links('vendor.pagination.tailwind') }}
        </div>
    @else
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mt-3" role="alert">
            You have no items in your watchlist.
        </div>
    @endif
</div>
@endsection
