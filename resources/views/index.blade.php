@extends('layouts.app')
@section('content')
    <div class="container">
        <x-hero-movie :title="$latestMovie->title" :release-date="$latestMovie->release_date" :synopsis="$latestMovie->synopsis">
            <img class="rounded-start w-100" src="{{ $latestMovie->photo_url }}" alt="{{ $latestMovie->title }}"
                width="720"></x-hero-movie>
        <div class="container mt-5 mb-5">
            <h1>Top 5 Movies</h1>
            <div class="row row-cols-5">
                @foreach ($movies->take(5) as $movie)
                    <x-content-card :title="$movie->title" :photo-url="$movie->photo_url" :release-date="$movie->release_date" :average-rating="$movie->averageRating" />
                @endforeach
            </div>
        </div>
        <div class="container text-center mt-5">
            <div class="p-5 lc-block">
                <div class="lc-block mb-4">
                    <div editable="rich">
                        <h2 class="fw-bold display-6">Movies for everyone!</h2>
                    </div>
                </div>
                <div class="lc-block mb-5">
                    <div editable="rich">
                        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore</p>
                    </div>
                </div>
                <div class="lc-block mb-2">
                    <a class="btn btn-danger" style="width: 100px;" href="#" role="button">GENRE</a>
                    <a class="btn btn-danger ms-5" style="width: 100px;" href="#" role="button">GENRE</a>
                    <a class="btn btn-danger ms-5" style="width: 100px;" href="#" role="button">GENRE</a>
                    <a class="btn btn-danger ms-5" style="width: 100px;" href="#" role="button">GENRE</a>
                    <a class="btn btn-danger ms-5" style="width: 100px;" href="#" role="button">GENRE</a>
                </div>
            </div>
        </div>
        <div class="container mt-5 mb-5">
            <h1>All Movies</h1>
            <div class="row row-cols-4">
                @foreach ($movies->shuffle()->take(8) as $movie)
                    <x-content-card :title="$movie->title" :photo-url="$movie->photo_url" :release-date="$movie->release_date" :average-rating="$movie->averageRating" class="h-100" />
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-2">
                <a href="#" class="btn btn-danger" style="width: 100px;">View All</a>
            </div>
        </div>
        <div class="container mt-5 mb-5">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="card-title">Want to be a part of us?</h1>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <div class="mt-4">
                        <a href="#" class="btn btn-danger btn-lg">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
