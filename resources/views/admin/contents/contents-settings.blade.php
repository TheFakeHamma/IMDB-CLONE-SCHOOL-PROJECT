@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Content Management</h1>
        <!-- Button to trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createContentModal">
            Add New Content
        </button>
        <!-- Create Content Modal -->
        <div class="modal fade" id="createContentModal" tabindex="-1" aria-labelledby="createContentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createContentModalLabel">Add New Content</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Display Validation Errors -->
                        @if ($errors->any())
                            <div>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.content.create') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="synopsis" class="form-label">Synopsis</label>
                                <textarea class="form-control" id="synopsis" name="synopsis"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-control" name="type" id="type">
                                    <option value="movie">Movie</option>
                                    <option value="tv_show">TV Show</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="genres" class="form-label">Genres</label>
                                @foreach ($genres as $genre)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="genres[]"
                                            value="{{ $genre->id }}" id="genre_{{ $genre->id }}">
                                        <label class="form-check-label" for="genre_{{ $genre->id }}">
                                            {{ $genre->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <label for="release_date" class="form-label">Release Date</label>
                                <input type="date" class="form-control" id="release_date" name="release_date">
                            </div>
                            <div class="mb-3">
                                <label for="photo_url" class="form-label">Photo URL</label>
                                <input type="url" class="form-control" id="photo_url" name="photo_url">
                            </div>
                            <div class="mb-3">
                                <label for="trailer_url" class="form-label">Trailer URL</label>
                                <input type="url" class="form-control" id="trailer_url" name="trailer_url">
                            </div>
                            <button type="submit" class="btn btn-primary">Create Content</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Release Date</th>
                    <th scope="col">Type</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contents as $content)
                    <tr>
                        <th scope="row">{{ $content->id }}</th>
                        <td>{{ $content->title }}</td>
                        <td>{{ $content->release_date->format('Y-m-d') }}</td>
                        <td>{{ $content->type }}</td>
                        <td>
                            <!-- Updated part: Trigger edit options modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editContentOptionsModal{{ $content->id }}">
                                Edit
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteConfirmationModal{{ $content->id }}">Delete</button>
                            <!-- Edit Options Modal -->
                            <div class="modal fade" id="editContentOptionsModal{{ $content->id }}" tabindex="-1"
                                aria-labelledby="editContentOptionsModalLabel{{ $content->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editContentOptionsModalLabel{{ $content->id }}">
                                                Edit Options for: {{ $content->title }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <a href="{{ route('admin.content.edit', $content->id) }}"
                                                class="btn btn-warning mb-2">Edit Movie</a>
                                            <a href="{{ route('admin.manage.cast', $content->id) }}"
                                                class="btn btn-info">Manage Cast</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="deleteConfirmationModal{{ $content->id }}" tabindex="-1"
                                aria-labelledby="deleteConfirmationModalLabel{{ $content->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $content->id }}">
                                                Confirm Deletion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this content? This action cannot be undone.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('admin.content.destroy', $content->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
