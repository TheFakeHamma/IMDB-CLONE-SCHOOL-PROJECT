@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-5">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/4">
                <img src="{{ $person->photo_url }}" class="w-full h-auto" alt="Photo of {{ $person->name }}">
            </div>
            <div class="w-full md:w-2/3 mx-5">
                <h1 class="text-2xl text-white font-bold mt-2 md:mt-0">{{ $person->name }}</h1>
                <!-- Conditional Bio with Read more functionality -->
                @if (strlen($person->bio) > 1000)
                    <p id="bio-short" class="mt-4 text-white">
                        {{ \Illuminate\Support\Str::limit($person->bio, 1000, '...') }}
                        <button onclick="toggleBio()" class="text-blue-300 hover:text-blue-500">Read more</button>
                    </p>
                    <p id="bio-full" class="mt-4 text-white hidden">
                        {{ $person->bio }}
                        <button onclick="toggleBio()" class="text-blue-300 hover:text-blue-500">Read less</button>
                    </p>
                @else
                    <p class="mt-4 text-white">{{ $person->bio }}</p>
                @endif
            </div>
        </div>
        <div class="mt-4">
            <h2 class="text-xl text-white font-semibold">Movies/Shows</h2>
            <div class="flex flex-wrap -mx-2">
                @foreach ($person->contents as $content)
                    <div class="max-w-[20rem] rounded-lg shadow mx-5 my-3 bg-gray-800 border-gray-700 flex flex-col">
                        <a href="{{ route('content.show', $content->id) }}">
                            <img class="rounded-t-lg flex-shrink-0" src="{{ $content->photo_url }}"
                                alt="{{ $content->title }}" />
                        </a>
                        <div class="p-5 flex flex-grow flex-col">
                            <a href="{{ route('content.show', $content->id) }}">
                                <h5 class="mb-2 text-xl font-bold tracking-tight text-white">{{ $content->title }}</h5>
                            </a>
                            <p class="mb-3 text-md flex-grow font-normal text-gray-400">
                                Role: {{ $content->pivot->role }}</p>
                            <p class="mb-3 text-sm flex-grow font-normal italic text-gray-400">
                                Release Date:
                                {{ $content->release_date->format('Y') }}</p>
                            <a href="{{ route('content.show', $content->id) }}"
                                class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Go to {{ $content->type === 'movie' ? 'Movie' : 'Show' }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function toggleBio() {
            var shortBio = document.getElementById('bio-short');
            var fullBio = document.getElementById('bio-full');
            if (shortBio.style.display === 'none') {
                shortBio.style.display = 'block';
                fullBio.style.display = 'none';
            } else {
                shortBio.style.display = 'none';
                fullBio.style.display = 'block';
            }
        }
    </script>
@endsection
