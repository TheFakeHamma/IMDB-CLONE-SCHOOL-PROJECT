@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>All movies & shows</h1>
        <form action="{{ route('contents') }}" method="GET">
            <div class="form-group">
                <ul>
                    <label for="genre">Genre</label>
                    @foreach ($genres as $genre)
                        <li>
                            <label class="form-check-label" for="genre">
                                {{ $genre->name }}
                            </label>
                            <input class="form-check-input" type="checkbox" value="{{ $genre->name }}" id="genre">
                        </li>
                    @endforeach
                </ul>
                {{-- <select name="genre" id="genre" class="form-control">
                    <option value="">Select Genre</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->name }}">{{ $genre->name }}</option>
                    @endforeach
                </select> --}}
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control">
                    <option value="">Select Type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->type }}">{{ ucfirst($type->type) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="release_date_from">Release Date From:</label>
                <input type="date" id="release_date_from" name="release_date_from" class="form-control">
            </div>

            <div class="form-group">
                <label for="release_date_to">Release Date To:</label>
                <input type="date" id="release_date_to" name="release_date_to" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <div class="row row-cols-4 mt-5">
            @foreach ($contents as $content)
                <x-content-card :title="$content->title" :photo-url="$content->photo_url" :release-date="$content->release_date" class="h-100" />
            @endforeach
        </div>
        <div class="mt-4">
            {{ $contents->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
