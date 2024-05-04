@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap">
            <div class="w-full">
                <x-hero-movie :title="$content->title" :release-date="$content->release_date" :synopsis="$content->synopsis" :id="$content->id">
                    <iframe width="100%" height="315" src="{{ $content->trailer_url }}" frameborder="0"
                            title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                </x-hero-movie>

                @if (Auth::check() && !Auth::user()->watchlist->contains('content_id', $content->id))
                    <form method="POST" action="{{ route('watchlist.add', $content->id) }}" class="mt-4">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add to Watchlist</button>
                    </form>
                @endif

                <div class="mt-8">
                    <h3 class="text-xl font-bold">Cast</h3>
                    <div class="flex flex-wrap -mx-2">
                        @foreach ($content->people as $person)
                            <x-people-card :name="$person->name" :photo-url="$person->photo_url" :bio="$person->bio" :role="$person->pivot->role" />
                        @endforeach
                    </div>
                </div>
                <div class="mt-8">
                    <h3 class="text-xl font-bold">Categories</h3>
                    @foreach ($content->genres as $genre)
                        <span class="inline-block bg-blue-200 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{ $genre->name }}</span>
                    @endforeach
                </div>

                <div class="mt-8">
                    <h3 class="text-xl font-bold">Reviews</h3>
                    @if (Auth::check())
                        <div class="mt-4">
                            <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-bs-toggle="modal"
                                    data-bs-target="#addReviewModal">
                                Add Review
                            </button>

                            <!-- Modal for adding a review -->
                            <div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="addReviewModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addReviewModalLabel">Add a Review</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form for adding a review -->
                                            <form action="{{ route('reviews.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="content_id" value="{{ $content->id }}">
                                                <div class="mb-3">
                                                    <label for="rating" class="form-label">Rating</label>
                                                    <select class="form-select" id="rating" name="rating">
                                                        <option selected>Choose a rating</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="review" class="form-label">Review</label>
                                                    <textarea class="form-control" id="review" name="review" rows="3"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit Review</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @forelse ($content->reviews as $review)
                        <x-review-card :review="$review" />
                    @empty
                        <p class="text-gray-700 mt-4">No reviews yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
