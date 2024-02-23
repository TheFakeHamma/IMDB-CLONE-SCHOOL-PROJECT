@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>All movies & shows</h1>
        <div class="row row-cols-4 mt-5">
            @foreach ($contents as $content)
                <x-content-card :title="$content->title" :photo-url="$content->photo_url" :release-date="$content->release_date" class="h-100"/>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $contents->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
