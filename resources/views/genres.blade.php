@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-white mt-6 mb-4">Genres</h1>
        <div class="flex flex-wrap -mx-2">
            @foreach ($genres as $genre)
                <div class="w-full md:w-1/3 px-2 mb-3">
                    <a href="{{ route('contents') }}?genre[]={{ $genre->name }}"
                       class="inline-block w-full bg-red-500 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg text-lg text-center">
                       {{ $genre->name }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
