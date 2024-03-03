@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $user->username }}'s Profile</h1>
        <p>Email: {{ $user->email }}</p>
        <!-- Button trigger modal -->
        @if (Auth::check() && Auth::user()->id == $user->id)
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                User Settings
            </button>

            <x-settings-modal :user="$user" />
        @endif


        <h3>User Reviews</h3>
        <div class="row">

            @forelse ($user->reviews as $review)
                <div class="col-sm-6 mb-3 mb-sm-0 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $review->content->title }}</h5>
                            <p class="card-text">
                                {{-- Display rating as stars --}}
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $review->rating)
                                        <span class="fa fa-star checked" style="color: orange;"></span>
                                    @else
                                        <span class="fa fa-star" style="color: grey;"></span>
                                    @endif
                                @endfor
                            </p>
                            <p class="card-text">{{ $review->review }}</p>
                            {{-- Link to the movie --}}
                            <a href="/content/{{ $review->content->id }}" class="btn btn-primary">Go to
                                {{ str_replace('_', ' ', $review->content->type) }}</a>
                            @if (Auth::check() && Auth::user()->id == $review->user_id)
                                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete Review</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p>No reviews yet.</p>
            @endforelse
        </div>
    </div>
@endsection
