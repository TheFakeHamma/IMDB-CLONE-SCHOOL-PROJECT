@extends('layouts.app')

@section('content')
    <div class="max-w-[100rem] mx-auto px-4 sm:px-6 lg:px-8">
        @php
            $heading = 'All People'; // Default heading

            if (request()->has('search')) {
                $heading = 'Search results for "' . request('search') . '"';
            }
        @endphp
        <h1 class="text-4xl text-[#FFFFFF] font-bold mt-20 mb-10">{{$heading}}</h1>
        @if ($people->count() > 0)
            {{-- Check if there are any people --}}
            <div class="grid grid-cols-4 gap-4 mt-5">
                @foreach ($people as $person)
                    <x-person-card :name="$person->name" :photo-url="$person->photo_url" :bio="$person->bio" :id="$person->id" />
                @endforeach
            </div>
            <div class="mt-10 flex justify-center">
                {{ $people->links('vendor.pagination.tailwind') }}  {{-- Make sure to create a Tailwind version of pagination --}}
            </div>
        @else
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                <p>No results found for your search.</p>
            </div>
        @endif
    </div>
@endsection
