@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-[80rem] px-4 sm:px-6 lg:px-[1rem]">
        @if (isset($latestMovie))
            <x-hero-movie :title="$latestMovie->title" :release-date="$latestMovie->release_date" :synopsis="$latestMovie->synopsis" :id="$latestMovie->id" :average-rating="$latestMovie->averageRating">
                <img class="w-full h-full rounded-sm shadow-lg" src="{{ $latestMovie->photo_url }}"
                    alt="{{ $latestMovie->title }}"></x-hero-movie>
        @else
            <p class="text-center">We are working on our website. New content will be available soon.</p>
        @endif
        <div class="mt-5 mb-5">
            <h1 class="text-4xl text-[#FFFFFF] font-bold mt-20 mb-10">Our Top 5</h1>
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
        <div class="text-center mt-8">
            <div class="py-5">
                <div class="mb-4">
                    <h2 class="text-5xl text-white font-bold">Movies for everyone!</h2>
                </div>
                <div class="mb-5 mt-8">
                    <p class="text-2xl text-[#ADADADCC] leading-relaxed w-2/3 mx-auto">
                        Discover a world of cinematic wonders where each genre unveils a new story and every film takes you
                        on a unique adventure. Explore epic landscapes, intimate dramas, and exhilarating narratives that
                        captivate and inspire, all from the comfort of your home.
                    </p>
                </div>
                @if ($topGenres->isNotEmpty())
                    <div class="mb-2 mt-8">
                        @foreach ($topGenres as $genre)
                            <a class="inline-block bg-red-500 text-lg text-white font-bold py-2 px-4 rounded-lg mx-4 mb-2"
                                style="min-width: 180px;"
                                href="{{ route('contents') }}?genre[]={{ $genre->name }}&type=movie" role="button">
                                {{ $genre->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="mt-5 mb-5">
            <h1 class="text-4xl text-[#FFFFFF] font-bold mt-20 mb-10">All Movies</h1>
            @if ($movies->isNotEmpty())
                <div class="grid grid-cols-4 gap-4">
                    @foreach ($movies->shuffle()->take(8) as $movie)
                        <x-content-card :title="$movie->title" :photo-url="$movie->photo_url" :release-date="$movie->release_date" :average-rating="$movie->averageRating"
                            :id="$movie->id" class="h-full" />
                    @endforeach
                </div>
                <div class="flex justify-center mt-10">
                    <a href="{{ route('contents') }}?type=movie"
                        class="bg-red-500 text-white text-xl text-center font-bold py-2 px-4 rounded-lg"
                        style="min-width: 200px;">View All</a>
                </div>
            @else
                <p class="text-center">We are working on our website. New content will be available soon.</p>
            @endif
        </div>
        @guest
            <div class="mt-20 mb-20 bg-[#D9D9D9] shadow-lg rounded-lg py-10 px-20">
                <h1 class="text-6xl font-bold text-[#171219]">Want to be a part of us?</h1>
                <p class="text-2xl text-[#000000CC] mt-5 w-4/5"> Join our community and explore a universe of film and
                    television with
                    exclusive access and personalized recommendations. Become a part of something bigger where your passion for
                    cinema comes to life.
                </p>
                <a href="{{ route('register') }}"
                    class="text-center mt-10 inline-block bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg text-2xl transition-colors duration-150"
                    style="min-width: 250px">Sign
                    Up</a>
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
                        <a href="{{ route('watchlist') }}" class="bg-red-500 text-white py-2 px-4 rounded-lg">Go to my
                            watchlist</a>
                    </div>
                @else
                    <p class="text-center">You haven't added anything to your watchlist yet. Browse movies and shows and add
                        them to start building
                        your watchlist!</p>
                @endif
            </div>
        @endguest
    </div>
@endsection
