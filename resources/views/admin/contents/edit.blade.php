@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen py-8">
    <div class="w-full max-w-3xl bg-white bg-opacity-90 rounded-lg shadow-lg p-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-900">Edit Content: {{ $content->title }}</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">There were some problems with your input.</span>
                <ul class="list-disc pl-5 mt-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.content.update', $content->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" value="{{ $content->title }}">
            </div>
            <div class="mb-4">
                <label for="synopsis" class="block text-gray-700 text-sm font-bold mb-2">Synopsis</label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="synopsis" name="synopsis">{{ $content->synopsis }}</textarea>
            </div>
            <div class="mb-4">
                <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" id="type" name="type">
                    <option value="movie" {{ $content->type == 'movie' ? 'selected' : '' }}>Movie</option>
                    <option value="tv_show" {{ $content->type == 'tv_show' ? 'selected' : '' }}>TV Show</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="genres" class="block text-gray-700 text-sm font-bold mb-2">Genres</label>
                @foreach ($allGenres as $genre)
                    <div class="flex items-center mb-2">
                        <input class="h-5 w-5 text-blue-600" type="checkbox" name="genres[]" id="genre{{ $genre->id }}"
                            value="{{ $genre->id }}" {{ $content->genres->contains($genre->id) ? 'checked' : '' }}>
                        <label for="genre{{ $genre->id }}" class="ml-2 text-gray-700">
                            {{ $genre->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="mb-4">
                <label for="release_date" class="block text-gray-700 text-sm font-bold mb-2">Release Date</label>
                <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="release_date" name="release_date"
                    value="{{ $content->release_date->format('Y-m-d') }}">
            </div>
            <div class="mb-4">
                <label for="photo_url" class="block text-gray-700 text-sm font-bold mb-2">Photo URL</label>
                <input type="url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="photo_url" name="photo_url"
                    value="{{ $content->photo_url }}">
            </div>
            <div class="mb-4">
                <label for="trailer_url" class="block text-gray-700 text-sm font-bold mb-2">Trailer URL</label>
                <input type="url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="trailer_url" name="trailer_url"
                    value="{{ $content->trailer_url }}">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Content</button>
                <a href="{{ route('admin.contents.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
