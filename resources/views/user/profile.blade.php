@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $user->username }}'s Profile</h1>
        <p>Email: {{ $user->email }}</p>

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
                        </div>
                    </div>
                </div>
            @empty
                <p>No reviews yet.</p>
            @endforelse
        </div>
    </div>
@endsection
