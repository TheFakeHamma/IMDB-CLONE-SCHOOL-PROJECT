@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-white">{{ $user->username }}'s Profile</h1>
        <p class="text-white mt-2">Email: {{ $user->email }}</p>

        <!-- Button trigger modal -->
        @if (Auth::check() && Auth::user()->id == $user->id)
            <button id="openModalBtn" type="button" class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold mt-5 py-2 px-4 rounded">
                User Settings
            </button>

            <!-- Settings Modal -->
            <x-settings-modal :user="$user" />
        @endif

        <h3 class="text-2xl font-semibold text-white mt-6">User Reviews</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
            @forelse ($user->reviews as $review)
                <div class="mb-4">
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="p-4">
                            <h5 class="text-lg font-bold">{{ $review->content->title }}</h5>
                            <div class="flex">
                                {{-- Display rating as stars --}}
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $review->rating)
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.5 3 1.5-5.5L0 8h5.6L10 3l3.4 5H19l-5 4.5 1.5 5.5z"/></svg>
                                    @else
                                        <svg class="w-5 h-5 text-gray-300 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.5 3 1.5-5.5L0 8h5.6L10 3l3.4 5H19l-5 4.5 1.5 5.5z"/></svg>
                                    @endif
                                @endfor
                            </div>
                            <p class="mt-2">{{ $review->review }}</p>
                            <a href="/content/{{ $review->content->id }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Go to
                                {{ str_replace('_', ' ', $review->content->type) }}</a>
                            @if (Auth::check() && Auth::user()->id == $review->user_id)
                                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="mt-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete Review</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">No reviews yet.</p>
            @endforelse
        </div>
    </div>

    <!-- Modal Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('exampleModal');
            const openModalBtn = document.getElementById('openModalBtn');
            const closeModalBtns = document.querySelectorAll('.close-button'); // This selects all close buttons if there are multiple.
    
            openModalBtn.addEventListener('click', function () {
                modal.classList.remove('hidden'); // Show modal
            });
    
            closeModalBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    modal.classList.add('hidden'); // Hide modal
                });
            });
    
            // Optionally, close the modal by clicking outside of it
            window.addEventListener('click', function (event) {
                if (event.target == modal) {
                    modal.classList.add('hidden'); // Hide modal
                }
            });
        });
    </script>
    
@endsection
