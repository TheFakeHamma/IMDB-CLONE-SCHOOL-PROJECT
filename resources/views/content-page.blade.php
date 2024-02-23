@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <x-hero-movie :title="$content->title" :release-date="$content->release_date" :synopsis="$content->synopsis">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/s_76M4c4LTo?si=3ZJm0TF9GFy4k7br"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </x-hero-movie>

                <div>
                    <h3>Cast</h3>
                    <div class="row">
                        @foreach ($content->people as $person)
                            <x-people-card :name="$person->name" :photo-url="$person->photo_url" :bio="$person->bio" :role="$person->pivot->role" />
                        @endforeach
                    </div>
                </div>
                <div>
                    <h3>Categories</h3>
                    @foreach ($content->genres as $genre)
                        <span class="badge text-bg-info">{{ $genre->name }}</span>
                    @endforeach
                </div>
                <div class="mt-4">
                    <h3>Reviews</h3>
                    @forelse ($content->reviews as $review)
                        <div class="card mt-3">
                            <div class="card-header">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $review->rating)
                                        <i class="fas fa-star" style="color: gold;"></i>
                                    @else
                                        <i class="far fa-star" style="color: gold;"></i>
                                    @endif
                                @endfor
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p>{{ $review->review }}</p>
                                    <footer class="blockquote-footer"><cite
                                            title="Source Title">{{ $review->user->username }}</cite></footer>
                                </blockquote>
                            </div>
                        </div>
                    @empty
                        <p>No reviews yet.</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
@endsection
