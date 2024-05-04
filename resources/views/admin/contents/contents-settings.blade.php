@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold my-6">Content Management</h1>
    <!-- Button to trigger modal -->
    <button onclick="openModal('createContentModal')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
        Add New Content
    </button>

    <!-- Create Content Modal -->
    <div class="hidden modal" id="createContentModal">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800">Add New Content</h5>
                    <button onclick="closeModal('createContentModal')" class="text-gray-400 hover:text-gray-500" aria-label="Close">✖️</button>
                </div>
                <div class="modal-body relative p-4">
                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="text-red-500">
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
                            <input type="text" class="form-input mt-1 block w-full" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="synopsis" class="form-label">Synopsis</label>
                            <textarea class="form-textarea mt-1 block w-full" id="synopsis" name="synopsis"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select block w-full mt-1" name="type" id="type">
                                <option value="movie">Movie</option>
                                <option value="tv_show">TV Show</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="genres" class="form-label">Genres</label>
                            @foreach ($genres as $genre)
                                <div class="form-check">
                                    <input class="form-checkbox h-5 w-5 text-blue-600" type="checkbox" name="genres[]"
                                        value="{{ $genre->id }}" id="genre_{{ $genre->id }}">
                                    <label class="form-check-label ml-2" for="genre_{{ $genre->id }}">
                                        {{ $genre->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="release_date" class="form-label">Release Date</label>
                            <input type="date" class="form-input mt-1 block w-full" id="release_date" name="release_date">
                        </div>
                        <div class="mb-3">
                            <label for="photo_url" class="form-label">Photo URL</label>
                            <input type="url" class="form-input mt-1 block w-full" id="photo_url" name="photo_url">
                        </div>
                        <div class="mb-3">
                            <label for="trailer_url" class="form-label">Trailer URL</label>
                            <input type="url" class="form-input mt-1 block w-full" id="trailer_url" name="trailer_url">
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Content</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="min-w-full leading-normal mt-8">
        <thead>
            <tr>
                <th scope="col" class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
                <th scope="col" class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Title</th>
                <th scope="col" class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Release Date</th>
                <th scope="col" class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                <th scope="col" class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contents as $content)
                <tr>
                    <th scope="row" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $content->id }}</th>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $content->title }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $content->release_date->format('Y-m-d') }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $content->type }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm flex space-x-2">
                        <button onclick="openModal('editContentOptionsModal{{ $content->id }}')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </button>
                        <button onclick="openModal('deleteConfirmationModal{{ $content->id }}')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Delete
                        </button>
                        <!-- Edit Options Modal -->
                        <div class="hidden modal" id="editContentOptionsModal{{ $content->id }}">
                            <div class="modal-dialog relative w-auto pointer-events-none">
                                <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                                    <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                                        <h5 class="text-xl font-medium leading-normal text-gray-800">Edit Options for: {{ $content->title }}</h5>
                                        <button onclick="closeModal('editContentOptionsModal{{ $content->id }}')" class="text-gray-400 hover:text-gray-500" aria-label="Close">✖️</button>
                                    </div>
                                    <div class="modal-body relative p-4 flex flex-col space-y-2">
                                        <a href="{{ route('admin.content.edit', $content->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit Movie</a>
                                        <a href="{{ route('admin.manage.cast', $content->id) }}" class="bg-blue-300 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded">Manage Cast</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Delete Confirmation Modal -->
                        <div class="hidden modal" id="deleteConfirmationModal{{ $content->id }}">
                            <div class="modal-dialog relative w-auto pointer-events-none">
                                <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                                    <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                                        <h5 class="text-xl font-medium leading-normal text-gray-800">Confirm Deletion</h5>
                                        <button onclick="closeModal('deleteConfirmationModal{{ $content->id }}')" class="text-gray-400 hover:text-gray-500" aria-label="Close">✖️</button>
                                    </div>
                                    <div class="modal-body relative p-4">
                                        Are you sure you want to delete this content? This action cannot be undone.
                                    </div>
                                    <div class="modal-footer flex justify-end p-4">
                                        <button onclick="closeModal('deleteConfirmationModal{{ $content->id }}')" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                                            Cancel
                                        </button>
                                        <form action="{{ route('admin.content.destroy', $content->id) }}" method="POST" class="ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
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

<script>
function openModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.modal-content').forEach(modalContent => {
        modalContent.addEventListener('click', event => {
            event.stopPropagation();
        });
    });

    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', () => {
            closeModal(modal.id);
        });
    });
});
</script>

@endsection
