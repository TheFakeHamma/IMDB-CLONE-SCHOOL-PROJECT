@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold my-6">Genres Management</h1>
    <!-- Button to trigger modal -->
    <button onclick="openModal('createGenreModal')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
        Add New Genre
    </button>

    <!-- Create Genre Modal -->
    <div class="hidden modal" id="createGenreModal">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800">Add New Genre</h5>
                    <button onclick="closeModal('createGenreModal')" class="text-gray-400 hover:text-gray-500" aria-label="Close">✖️</button>
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

                    <form action="{{ route('admin.genre.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-input mt-1 block w-full" id="name" name="name" required>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Genre</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="min-w-full leading-normal mt-8">
        <thead>
            <tr>
                <th scope="col" class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
                <th scope="col" class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                <th scope="col" class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($genres as $genre)
                <tr>
                    <th scope="row" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $genre->id }}</th>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $genre->name }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <!-- Trigger modal button for Edit -->
                        <button onclick="openModal('editGenreModal{{ $genre->id }}')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </button>
                        <!-- Edit Genre Modal -->
                        <div class="hidden modal" id="editGenreModal{{ $genre->id }}">
                            <div class="modal-dialog relative w-auto pointer-events-none">
                                <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                                    <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                                        <h5 class="text-xl font-medium leading-normal text-gray-800">Edit Genre: {{ $genre->name }}</h5>
                                        <button onclick="closeModal('editGenreModal{{ $genre->id }}')" class="text-gray-400 hover:text-gray-500" aria-label="Close">✖️</button>
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
                                        <form action="{{ route('admin.genre.update', $genre->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-3">
                                                <label for="name{{ $genre->id }}" class="form-label">Name</label>
                                                <input type="text" class="form-input mt-1 block w-full" id="name{{ $genre->id }}"
                                                    name="name" value="{{ $genre->name }}" required>
                                            </div>

                                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Genre</button>
                                        </form>
                                        <form class="mt-2" action="{{ route('admin.genre.destroy', $genre->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this genre?');">
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
