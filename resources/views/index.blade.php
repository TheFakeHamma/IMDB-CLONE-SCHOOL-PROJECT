@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-[100rem] px-4 sm:px-6 lg:px-[1rem]">
        @if (isset($latestMovie))
            <x-hero-movie :title="$latestMovie->title" :release-date="$latestMovie->release_date" :synopsis="$latestMovie->synopsis" :id="$latestMovie->id" :average-rating="$latestMovie->averageRating">
                <img class="w-full h-full rounded-sm shadow-lg" src="{{ $latestMovie->photo_url }}" alt="{{ $latestMovie->title }}"></x-hero-movie>
        @else
            <p class="text-center">We are working on our website. New content will be available soon.</p>
        @endif
        <div class="mt-5 mb-5">
            <h1 class="text-3xl text-[#FFFFFF] font-bold mt-20 mb-10">Top 5 Movies</h1>
            @if ($topMovies->isNotEmpty())
                <div class="grid grid-cols-5 gap-4">
                    @foreach ($topMovies as $movie)
                        <x-content-card :title="$movie->title" :photo-url="$movie->photo_url" :release-date="$movie->release_date" :average-rating="$movie->reviews_avg_rating"
                            :id="$movie->id" />
                    @endforeach
                </div>
            @else
                <p class="text-center">We are working on our website. New content will be available soon.</p>
            @endif
        </div>
        <div class="text-center mt-5">
            <div class="py-5">
                <div class="mb-4">
                    <h2 class="text-4xl font-bold">Movies for everyone!</h2>
                </div>
                <div class="mb-5">
                    <p class="text-lg leading-relaxed">Discover a world of cinematic wonders, where every genre tells a new story and
                        every movie takes you on a unique journey.</p>
                </div>
                @if ($topGenres->isNotEmpty())
                    <div class="mb-2">
                        @foreach ($topGenres as $genre)
                            <a class="inline-block bg-red-500 text-white py-2 px-4 rounded-lg mr-2 mb-2" style="min-width: 100px;"
                                href="{{ route('contents') }}?genre[]={{ $genre->name }}&type=movie" role="button">
                                {{ $genre->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="mt-5 mb-5">
            <h1 class="text-3xl font-bold">All Movies</h1>
            @if ($movies->isNotEmpty())
                <div class="grid grid-cols-4 gap-4">
                    @foreach ($movies->shuffle()->take(8) as $movie)
                        <x-content-card :title="$movie->title" :photo-url="$movie->photo_url" :release-date="$movie->release_date" :average-rating="$movie->averageRating"
                            :id="$movie->id" class="h-full" />
                    @endforeach
                </div>
                <div class="flex justify-center mt-2">
                    <a href="{{ route('contents') }}?type=movie" class="bg-red-500 text-white py-2 px-4 rounded-lg" style="width: 100px;">View All</a>
                </div>
            @else
                <p class="text-center">We are working on our website. New content will be available soon.</p>
            @endif
        </div>
        @guest
            <div class="mt-5 mb-5">
                <div class="bg-white shadow-md rounded-lg text-center py-5 px-4">
                    <h1 class="text-3xl font-bold">Want to be a part of us?</h1>
                    <p class="text-lg">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <div class="mt-4">
                        <a href="{{ route('register') }}" class="bg-red-500 text-white py-3 px-6 rounded-lg text-lg">Sign Up</a>
                    </div>
                </div>
            </div>
        @else
            <div class="mt-5 mb-5">
                <h1 class="text-3xl font-bold">My Watchlist</h1>
                @if ($watchListItems->isNotEmpty())
                    <div class="grid grid-cols-5 gap-4">
                        @foreach ($watchListItems as $item)
                            <x-content-card :title="$item->content->title" :photo-url="$item->content->photo_url" :release-date="$item->content->release_date" :average-rating="$item->content->averageRating"
                                :id="$item->content->id" />
                        @endforeach
                    </div>
                    <div class="flex justify-center mt-2">
                        <a href="{{ route('watchlist') }}" class="bg-red-500 text-white py-2 px-4 rounded-lg">Go to my watchlist</a>
                    </div>
                @else
                    <p class="text-center">You haven't added anything to your watchlist yet. Browse movies and shows and add them to start building
                        your watchlist!</p>
                @endif
            </div>
        @endguest
    </div>
@endsection
