@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold my-4">Your Watchlist</h1>

    <form action="{{ route('watchlist') }}" method="GET" class="mb-6">
        <h6 class="font-medium">Genre</h6>
        @foreach ($genres as $genre)
            <div class="form-check form-check-inline">
                <input class="form-checkbox h-5 w-5 text-blue-600" type="checkbox" name="genres[]" value="{{ $genre->id }}"
                    id="genre_{{ $genre->id }}" {{ in_array($genre->id, request('genres', [])) ? 'checked' : '' }}>
                <label class="ml-2 text-lg" for="genre_{{ $genre->id }}">{{ $genre->name }}</label>
            </div>
        @endforeach

        <h6 class="font-medium">Movie or TV Show</h6>
        @foreach ($types as $type)
            <div class="form-check form-check-inline">
                <input class="form-radio h-5 w-5 text-blue-600" type="radio" name="type" value="{{ $type }}"
                    id="type_{{ $type }}" {{ request('type') == $type ? 'checked' : '' }}>
                <label class="ml-2 text-lg" for="type_{{ $type }}">{{ ucfirst($type) }}</label>
            </div>
        @endforeach

        <div class="flex flex-wrap -mx-2">
            <div class="w-full md:w-1/2 px-2 mb-4">
                <label for="release_date_from">Release Date From:</label>
                <input type="date" id="release_date_from" name="release_date_from" class="form-input mt-1 block w-full"
                    value="{{ request('release_date_from') }}">
            </div>
            <div class="w-full md:w-1/2 px-2 mb-4">
                <label for="release_date_to">Release Date To:</label>
                <input type="date" id="release_date_to" name="release_date_to" class="form-input mt-1 block w-full"
                    value="{{ request('release_date_to') }}">
            </div>
        </div>

        <h6 class="font-medium">Watch Status</h6>
        <div class="form-check form-check-inline">
            <input class="form-radio h-5 w-5 text-blue-600" type="radio" name="watched_status" value="all" id="watched_status_all"
                {{ request('watched_status') == 'all' ? 'checked' : '' }}>
            <label class="ml-2 text-lg" for="watched_status_all">All</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-radio h-5 w-5 text-blue-600" type="radio" name="watched_status" value="watched"
                id="watched_status_watched" {{ request('watched_status') == 'watched' ? 'checked' : '' }}>
            <label class="ml-2 text-lg" for="watched_status_watched">Watched</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-radio h-5 w-5 text-blue-600" type="radio" name="watched_status" value="not_watched"
                id="watched_status_not_watched" {{ request('watched_status') == 'not_watched' ? 'checked' : '' }}>
            <label class="ml-2 text-lg" for="watched_status_not_watched">Not Watched</label>
        </div>
        <div class="mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Filter</button>
            @if (request()->except('page'))
                <a href="{{ route('watchlist') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Reset</a>
            @endif
        </div>
    </form>

    @if (session('success'))
        <div class="alert bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-wrap -mx-2">
        @forelse ($watchlistItems as $item)
            <div class="p-2 w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
                <div class="max-w-sm rounded overflow-hidden shadow-lg">
                    <img class="w-full" src="{{ $item->content->photo_url }}" alt="{{ $item->content->title }}">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{ $item->content->title }}</div>
                        <p class="text-gray-700 text-base">
                            Release date: {{ $item->content->release_date->format('Y') }}
                        </p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        @if (!$item->watched)
                            <form action="{{ route('watchlist.watched', $item->content_id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Mark as Watched</button>
                            </form>
                        @else
                            <form action="{{ route('watchlist.not-watched', $item->content_id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Unmark as Watched</button>
                            </form>
                        @endif
                        <a href="{{ route('content.show', ['id' => $item->content_id]) }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Go to Movie</a>
                        <form action="{{ route('watchlist.remove', $item->content_id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Remove</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>You have no items in your watchlist.</p>
        @endforelse
    </div>

    <div class="mt-4 flex justify-center">
        {{ $watchlistItems->links('vendor.pagination.tailwind') }}
    </div>
</div>
@endsection
