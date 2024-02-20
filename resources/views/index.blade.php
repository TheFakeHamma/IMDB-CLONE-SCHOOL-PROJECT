@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h1>8 movies</h1>
    <div class="row">
        @foreach ($movies as $movie)
            <x-content-card :title="$movie->title" :photo-url="$movie->photo_url" :release-date="$movie->release_date" />
        @endforeach
    </div>
</div>
@endsection