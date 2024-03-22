@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Content: {{ $content->title }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.content.update', $content->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $content->title }}">
            </div>
            <div class="mb-3">
                <label for="synopsis" class="form-label">Synopsis</label>
                <textarea class="form-control" id="synopsis" name="synopsis">{{ $content->synopsis }}</textarea>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type">
                    <option value="movie" {{ $content->type == 'movie' ? 'selected' : '' }}>Movie</option>
                    <option value="tv_show" {{ $content->type == 'tv_show' ? 'selected' : '' }}>TV Show</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="genres" class="form-label">Genres</label>
                @foreach ($allGenres as $genre)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="genres[]" id="genre{{ $genre->id }}"
                            value="{{ $genre->id }}" {{ $content->genres->contains($genre->id) ? 'checked' : '' }}>
                        <label class="form-check-label" for="genre{{ $genre->id }}">
                            {{ $genre->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="release_date" class="form-label">Release Date</label>
                <input type="date" class="form-control" id="release_date" name="release_date"
                    value="{{ $content->release_date->format('Y-m-d') }}">
            </div>
            <div class="mb-3">
                <label for="photo_url" class="form-label">Photo URL</label>
                <input type="url" class="form-control" id="photo_url" name="photo_url"
                    value="{{ $content->photo_url }}">
            </div>
            <div class="mb-3">
                <label for="trailer_url" class="form-label">Trailer URL</label>
                <input type="url" class="form-control" id="trailer_url" name="trailer_url"
                    value="{{ $content->trailer_url }}">
            </div>
            <button type="submit" class="btn btn-primary">Update Content</button>
            <a href="{{ route('admin.contents.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection