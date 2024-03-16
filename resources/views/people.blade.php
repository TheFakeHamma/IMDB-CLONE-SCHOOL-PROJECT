@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>All People</h1>
        <div class="row row-cols-4 mt-5">
            @foreach ($people as $person)
                <x-person-card :name="$person->name" :photo-url="$person->photo_url" :bio="$person->bio" :id="$person->id" />
            @endforeach
        </div>
        <div class="mt-4 d-flex justify-content-center">
            {{ $people->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
