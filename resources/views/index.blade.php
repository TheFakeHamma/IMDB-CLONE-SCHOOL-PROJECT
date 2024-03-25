@extends('layouts.app')
@section('content')
    <div class="container">
        <x-hero-movie :title="$latestMovie->title" :release-date="$latestMovie->release_date" :synopsis="$latestMovie->synopsis" :id="$latestMovie->id">
            <img class="rounded-start w-100" src="{{ $latestMovie->photo_url }}" alt="{{ $latestMovie->title }}"
                width="720"></x-hero-movie>
        <div class="container mt-5 mb-5">
            <h1>Top 5 Movies</h1>
            <div class="row row-cols-5">
                @foreach ($topMovies as $movie)
                    <x-content-card :title="$movie->title" :photo-url="$movie->photo_url" :release-date="$movie->release_date" :average-rating="$movie->reviews_avg_rating"
                        :id="$movie->id" />
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
                        <p class="lead">Discover a world of cinematic wonders, where every genre tells a new story and
                            every movie takes you on a unique journey.</p>
                    </div>
                </div>
                <div class="lc-block mb-2">
                    @foreach ($topGenres as $genre)
                        <a class="btn btn-danger" style="min-width: 100px; margin-right: 10px;" href="{{ route('contents') }}?genre[]={{ $genre->name }}&type=movie" role="button">
                            {{ $genre->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="container mt-5 mb-5">
            <h1>All Movies</h1>
            <div class="row row-cols-4">
                @foreach ($movies->shuffle()->take(8) as $movie)
                    <x-content-card :title="$movie->title" :photo-url="$movie->photo_url" :release-date="$movie->release_date" :average-rating="$movie->averageRating"
                        :id="$movie->id" class="h-100" />
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-2">
                <a href="{{ route('contents') }}?type=movie" class="btn btn-danger" style="width: 100px;">View All</a>
            </div>
        </div>
        @guest
            <div class="container mt-5 mb-5">
                <div class="card">
                    <div class="card-body text-center">
                        <h1 class="card-title">Want to be a part of us?</h1>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <div class="mt-4">
                            <a href="{{ route('register') }}" class="btn btn-danger btn-lg">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="container mt-5 mb-5">
                <h1>My Watchlist</h1>
                @if ($watchListItems->isNotEmpty())
                    <div class="row row-cols-5">
                        @foreach ($watchListItems as $item)
                            <x-content-card :title="$item->content->title" :photo-url="$item->content->photo_url" :release-date="$item->content->release_date" :average-rating="$item->content->averageRating"
                                :id="$item->content->id" />
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        <a href="{{ route('watchlist') }}" class="btn btn-danger">Go to my watchlist</a>
                    </div>
                @else
                    <p>You haven't added anything to your watchlist yet. Browse movies and shows and add them to start building
                        your watchlist!</p>
                @endif
            </div>
        @endguest
    </div>
@endsection
