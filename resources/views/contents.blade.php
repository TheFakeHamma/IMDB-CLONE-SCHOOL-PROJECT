@extends('layouts.app')
@section('content')
    <div class="container">
        @php
            $heading = 'All Content'; // Default heading

            if(request()->has('search')) {
                $heading = 'Search results for "' . request('search') . '"';
            } elseif(request()->has('genre')) {
                $heading = 'Filtered';
            } elseif(request('type') == 'movie') {
                $heading = 'Show all movies';
            } elseif(request('type') == 'tv_show') {
                $heading = 'Show all TV shows';
            }
        @endphp

        <h1>{{ $heading }}</h1>
        <form action="{{ route('contents') }}" method="GET">
            <div class="form-group">
                <h6>Genre</h6>
                @foreach ($genres as $genre)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="genre[]" value="{{ $genre->name }}"
                            id="genre_{{ $genre->id }}"
                            {{ is_array(request('genre')) && in_array($genre->name, request('genre')) ? 'checked' : '' }}>
                        <label class="form-check-label" for="genre_{{ $genre->id }}">
                            {{ $genre->name }}
                        </label>
                    </div>
                @endforeach

            </div>

            <div class="form-group mt-3">
                <h6>Movie or TV Show</h6>
                @foreach ($types as $type)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" value="{{ $type->type }}"
                            id="type_{{ $type->type }}" {{ request('type') == $type->type ? 'checked' : '' }}>
                        <label class="form-check-label" for="type_{{ $type->type }}">{{ ucfirst(str_replace('_', ' ',$type->type)) }}</label>
                    </div>
                @endforeach

            </div>

            <div class="row mt-3">
                <div class="form-group col">
                    <label for="release_date_from">Release Date From:</label>
                    <input type="date" id="release_date_from" name="release_date_from" class="form-control"
                        value="{{ request('release_date_from') }}">
                </div>

                <div class="form-group col">
                    <label for="release_date_to">Release Date To:</label>
                    <input type="date" id="release_date_to" name="release_date_to" class="form-control"
                        value="{{ request('release_date_to') }}">
                </div>

            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Filter</button>
                @if (request()->except('page'))
                    <a href="{{ route('contents') }}" class="btn btn-danger">Reset</a>
                @endif
            </div>
        </form>

        <div class="row row-cols-4 mt-5">
            @foreach ($contents as $content)
                <x-content-card :title="$content->title" :photo-url="$content->photo_url" :release-date="$content->release_date" class="h-100" />
            @endforeach
        </div>
        <div class="mt-4 d-flex justify-content-center">
            {{ $contents->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
