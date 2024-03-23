@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Watchlist</h1>

        <form action="{{ route('watchlist') }}" method="GET" class="mb-3">
            <h6>Genre</h6>
            @foreach ($genres as $genre)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="genres[]" value="{{ $genre->id }}"
                        id="genre_{{ $genre->id }}" {{ in_array($genre->id, request('genres', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="genre_{{ $genre->id }}">{{ $genre->name }}</label>
                </div>
            @endforeach

            <h6>Movie or TV Show</h6>
            @foreach ($types as $type)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" value="{{ $type }}"
                        id="type_{{ $type }}" {{ request('type') == $type ? 'checked' : '' }}>
                    <label class="form-check-label" for="type_{{ $type }}">{{ ucfirst($type) }}</label>
                </div>
            @endforeach

            <div class="row">
                <div class="col">
                    <label for="release_date_from">Release Date From:</label>
                    <input type="date" id="release_date_from" name="release_date_from" class="form-control"
                        value="{{ request('release_date_from') }}">
                </div>
                <div class="col">
                    <label for="release_date_to">Release Date To:</label>
                    <input type="date" id="release_date_to" name="release_date_to" class="form-control"
                        value="{{ request('release_date_to') }}">
                </div>
            </div>

            <h6>Watch Status</h6>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="watched_status" value="all" id="watched_status_all"
                    {{ request('watched_status') == 'all' ? 'checked' : '' }}>
                <label class="form-check-label" for="watched_status_all">All</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="watched_status" value="watched"
                    id="watched_status_watched" {{ request('watched_status') == 'watched' ? 'checked' : '' }}>
                <label class="form-check-label" for="watched_status_watched">Watched</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="watched_status" value="not_watched"
                    id="watched_status_not_watched" {{ request('watched_status') == 'not_watched' ? 'checked' : '' }}>
                <label class="form-check-label" for="watched_status_not_watched">Not Watched</label>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Filter</button>
                @if (request()->except('page'))
                    <a href="{{ route('watchlist') }}" class="btn btn-danger">Reset</a>
                @endif
            </div>
        </form>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @forelse ($watchlistItems as $item)
                <div class="col mb-4">
                    <div class="card h-100" style="width: 15rem;">
                        <img src="{{ $item->content->photo_url }}" class="card-img-top" alt="{{ $item->content->title }}">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">{{ $item->content->title }}</h5>
                                <footer class="blockquote-footer mt-2">Release date:
                                    {{ $item->content->release_date->format('Y') }}</footer>
                            </div>
                            <div>
                                @if (!$item->watched)
                                    <form action="{{ route('watchlist.watched', $item->content_id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Mark as Watched</button>
                                    </form>
                                @else
                                    <form action="{{ route('watchlist.not-watched', $item->content_id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">Unmark as Watched</button>
                                    </form>
                                @endif
                                <a href="{{ route('content.show', ['id' => $item->content_id]) }}"
                                    class="btn btn-info btn-sm">Go to Movie</a>
                                <form action="{{ route('watchlist.remove', $item->content_id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>You have no items in your watchlist.</p>
            @endforelse
        </div>

        <div class="row">
            <div class="mt-4 d-flex justify-content-center">
                {{ $watchlistItems->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
