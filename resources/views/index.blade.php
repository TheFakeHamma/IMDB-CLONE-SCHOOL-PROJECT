@extends('layouts.app')
@section('content')
    <div class="container">
        <x-hero-movie :title="$latestMovie->title" :photo-url="$latestMovie->photo_url" :release-date="$latestMovie->release_date" :synopsis="$latestMovie->synopsis" />
        <div class="container mt-5 mb-5">
            <h1>Top 5 Movies</h1>
            <div class="row row-cols-5">
                @foreach ($movies->take(5) as $movie)
                    <x-content-card :title="$movie->title" :photo-url="$movie->photo_url" :release-date="$movie->release_date" />
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
                        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore</p>
                    </div>
                </div>
                <div class="lc-block mb-2">
                    <a class="btn btn-primary" style="width: 100px;" href="#" role="button">GENRE</a>
                    <a class="btn btn-primary ms-5" style="width: 100px;" href="#" role="button">GENRE</a>
                    <a class="btn btn-primary ms-5" style="width: 100px;" href="#" role="button">GENRE</a>
                    <a class="btn btn-primary ms-5" style="width: 100px;" href="#" role="button">GENRE</a>
                    <a class="btn btn-primary ms-5" style="width: 100px;" href="#" role="button">GENRE</a>
                </div>
            </div>
        </div>
    </div>
@endsection
