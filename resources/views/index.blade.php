@extends('layouts.app')
@section('content')
    <div class="container">
        <x-hero-movie :title="$latestMovie->title" :photo-url="$latestMovie->photo_url" :release-date="$latestMovie->release_date" :synopsis="$latestMovie->synopsis" />
        <div class="container mt-5">
            <h1>Top 5 Movies</h1>
            <div class="row row-cols-5">
                @foreach ($movies->take(5) as $movie)
                    <x-content-card :title="$movie->title" :photo-url="$movie->photo_url" :release-date="$movie->release_date" />
                @endforeach

            </div>
        </div>
        <div class="container mt-5">
            <h1>8 movies</h1>
            <div class="row">
                @foreach ($movies as $movie)
                    <x-content-card :title="$movie->title" :photo-url="$movie->photo_url" :release-date="$movie->release_date" />
                @endforeach
            </div>
        </div>
    </div>
@endsection
