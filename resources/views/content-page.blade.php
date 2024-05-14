@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap">
            <div class="w-full">
                <x-hero-movie :title="$content->title" :release-date="$content->release_date" :synopsis="$content->synopsis" :id="$content->id">
                    <iframe width="100%" height="315" src="{{ $content->trailer_url }}" frameborder="0"
                        title="YouTube video player"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </x-hero-movie>

                @if (Auth::check() && !Auth::user()->watchlist->contains('content_id', $content->id))
                    <form method="POST" action="{{ route('watchlist.add', $content->id) }}" class="mt-4">
                        @csrf
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add to
                            Watchlist</button>
                    </form>
                @endif

                <div class="mt-8">
                    <h3 class="text-2xl text-white font-bold">Cast</h3>
                    <div class="flex flex-wrap -mx-2">
                        @foreach ($content->people as $person)
                            <x-people-card :name="$person->name" :photo-url="$person->photo_url" :bio="$person->bio" :role="$person->pivot->role" :id="$person->id" />
                        @endforeach
                    </div>
                </div>
                <div class="mt-8">
                    <h3 class="text-xl text-white font-bold">Categories</h3>
                    @foreach ($content->genres as $genre)
                        <span
                            class="inline-block bg-blue-200 text-blue-800 text-xs font-semibold mr-2 mt-2 px-2.5 py-0.5 rounded">{{ $genre->name }}</span>
                    @endforeach
                </div>

                <div class="mt-8">
                    <h3 class="text-2xl text-white font-bold mb-3">Reviews</h3>
                    @if (Auth::check())
                        <button type="button" id="addReviewButton"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-3">
                            Add Review
                        </button>

                        <!-- Modal for adding a review -->
                        <div id="addReviewModal" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center">
                            <div class="relative p-4 w-full max-w-md h-auto">
                                <!-- Modal content -->
                                <div class="relative bg-gray-700 rounded-lg shadow">
                                    <!-- Modal header -->
                                    <div class="flex justify-between items-center p-5 rounded-t border-b border-gray-600">
                                        <h3 class="text-xl font-bold text-white">Add a Review</h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                            onclick="closeModal()">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form class="p-6 space-y-6" action="{{ route('reviews.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="content_id" value="{{ $content->id }}">
                                        <div class="grid grid-cols-1 gap-6">
                                            <div>
                                                <label for="rating"
                                                    class="block mb-2 text-sm font-medium text-white">Rating</label>
                                                <select id="rating" name="rating"
                                                    class="bg-gray-600 border border-gray-500 text-white placeholder-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                    <option value="">Choose a rating</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="review"
                                                    class="block mb-2 text-sm font-medium text-white">Review</label>
                                                <textarea id="review" name="review" rows="4"
                                                    class="block w-full p-2.5 text-sm text-white bg-gray-600 rounded-lg border border-gray-500 focus:ring-blue-500 focus:border-blue-500"
                                                    placeholder="Write your review here..."></textarea>
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit
                                            Review</button>
                                    </form>
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

    <script>
        function closeModal() {
            document.getElementById('addReviewModal').classList.add('hidden');
        }

        document.getElementById('addReviewButton').addEventListener('click', function() {
            document.getElementById('addReviewModal').classList.remove('hidden');
        });

        window.addEventListener('click', (event) => {
            if (event.target === document.getElementById('addReviewModal')) {
                closeModal();
            }
        });
    </script>
@endsection
