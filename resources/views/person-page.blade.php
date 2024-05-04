@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-5">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/3">
                <img src="{{ $person->photo_url }}" class="w-full h-auto" alt="Photo of {{ $person->name }}">
            </div>
            <div class="w-full md:w-2/3">
                <h1 class="text-2xl font-bold mt-2 md:mt-0">{{ $person->name }}</h1>
                <p class="mt-4">{{ $person->bio }}</p>
            </div>
        </div>
        <div class="mt-4">
            <h2 class="text-xl font-semibold">Movies/Shows</h2>
            <div class="flex flex-wrap -mx-2">
                @foreach ($person->contents as $content)
                    <div class="w-full sm:w-1/2 md:w-1/4 p-2 mb-4">
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg h-full flex flex-col">
                            <img src="{{ $content->photo_url }}" class="w-full h-36 object-cover" alt="{{ $content->title }}">
                            <div class="p-4 flex flex-col flex-grow">
                                <h6 class="font-semibold">{{ $content->title }}</h6>
                                <p class="text-sm mt-1">Role: {{ $content->pivot->role }}</p>
                                <p class="text-sm">
                                    <small class="text-gray-600">Release Date:
                                        {{ $content->release_date->format('Y') }}</small>
                                </p>
                                <a href="{{ route('content.show', $content->id) }}" class="mt-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Go to {{ $content->type === 'movie' ? 'Movie' : 'Show' }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
