@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Genres</h1>
        <div class="row">
            @foreach ($genres as $genre)
                <div class="col-md-4 mt-3">
                    <a href="{{ route('contents') }}?genre[]={{ $genre->name }}"
                        class="btn btn-danger btn-lg">{{ $genre->name }}</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
