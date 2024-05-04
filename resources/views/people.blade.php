@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-900 mt-6 mb-2">All People</h1>
        @if ($people->count() > 0)
            {{-- Check if there are any people --}}
            <div class="grid grid-cols-4 gap-4 mt-5">
                @foreach ($people as $person)
                    <x-person-card :name="$person->name" :photo-url="$person->photo_url" :bio="$person->bio" :id="$person->id" />
                @endforeach
            </div>
            <div class="mt-4 flex justify-center">
                {{ $people->links('vendor.pagination.tailwind') }}  {{-- Make sure to create a Tailwind version of pagination --}}
            </div>
        @else
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                <p>No results found for your search.</p>
            </div>
        @endif
    </div>
@endsection
