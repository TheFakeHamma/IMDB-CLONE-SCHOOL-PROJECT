@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold text-white my-6">Genres Management</h1>
    <!-- Button to trigger modal -->
    <button onclick="openModal('createGenreModal')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4">
        Add New Genre
    </button>

    <!-- Create Genre Modal -->
    <div class="modal fixed inset-0 flex items-center justify-center z-50 hidden" id="createGenreModal">
        <div class="relative w-full max-w-lg pointer-events-auto">
            <div class="border-none shadow-lg relative flex flex-col w-full bg-white bg-clip-padding rounded-md outline-none text-current">
                <div class="flex items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium text-gray-800">Add New Genre</h5>
                    <button onclick="closeModal('createGenreModal')" class="text-gray-400 hover:text-gray-500" aria-label="Close">✖️</button>
                </div>
                <div class="relative p-4">
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
                            <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                            <input type="text" id="name" name="name" required
                                class="block w-full px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Genre</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-400">
            <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">#</th>
                    <th scope="col" class="py-3 px-6">Name</th>
                    <th scope="col" class="py-3 px-6">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($genres as $genre)
                    <tr class="border-b bg-gray-800 border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-white">{{ $genre->id }}</th>
                        <td class="py-4 px-6">{{ $genre->name }}</td>
                        <td class="py-4 px-6 flex space-x-2">
                            <!-- Trigger modal button for Edit -->
                            <button onclick="openModal('editGenreModal{{ $genre->id }}')" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </button>
                            <!-- Edit Genre Modal -->
                            <div class="modal fixed inset-0 flex items-center justify-center z-50 hidden" id="editGenreModal{{ $genre->id }}">
                                <div class="relative w-full max-w-lg pointer-events-auto">
                                    <div class="border-none shadow-lg relative flex flex-col w-full bg-white bg-clip-padding rounded-md outline-none text-current">
                                        <div class="flex items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                                            <h5 class="text-xl font-medium text-gray-800">Edit Genre: {{ $genre->name }}</h5>
                                            <button onclick="closeModal('editGenreModal{{ $genre->id }}')" class="text-gray-400 hover:text-gray-500" aria-label="Close">✖️</button>
                                        </div>
                                        <div class="relative p-4">
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
                                            <form action="{{ route('admin.genre.update', $genre->id) }}" method="POST" class="space-y-4">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="name{{ $genre->id }}" class="block text-gray-700 font-bold mb-2">Name</label>
                                                    <input type="text" id="name{{ $genre->id }}" name="name" value="{{ $genre->name }}" required
                                                        class="block w-full px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                </div>
                                                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Genre</button>
                                            </form>
                                            <form action="{{ route('admin.genre.destroy', $genre->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this genre?');" class="mt-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
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
</div>

<script>
function openModal(modalId) {
    document.getElementById(modalId).style.display = 'flex';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.modal-content').forEach(function(modalContent) {
        modalContent.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });

    document.querySelectorAll('.modal').forEach(function(modal) {
        modal.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal')) {
                closeModal(modal.id);
            }
        });
    });
});
</script>
@endsection
