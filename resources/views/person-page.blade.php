@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ $person->photo_url }}" class="img-fluid" alt="Photo of {{ $person->name }}">
            </div>
            <div class="col-md-8">
                <h1>{{ $person->name }}</h1>
                <p>{{ $person->bio }}</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <h2>Movies/Shows</h2>
                <div class="row">
                    @foreach ($person->contents as $content)
                        <div class="col-md-3 mb-3">
                            <div class="card h-100">
                                <img src="{{ $content->photo_url }}" class="card-img-top" alt="{{ $content->title }}"
                                    style="height: 150px; object-fit: cover;">
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title">{{ $content->title }}</h6>
                                    <p class="card-text">Role: {{ $content->pivot->role }}</p>
                                    <p class="card-text">
                                        <small class="text-muted">Release Date:
                                            {{ $content->release_date->format('Y') }}</small>
                                    </p>
                                    <a href="{{ route('content.show', $content->id) }}" class="btn btn-primary mt-auto">
                                        Go to {{ $content->type === 'movie' ? 'Movie' : 'Show' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
