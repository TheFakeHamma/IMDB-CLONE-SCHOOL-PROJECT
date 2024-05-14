@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold text-white my-6">People Management</h1>
    <!-- Button to trigger modal -->
    <button onclick="openModal('createPersonModal')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4">
        Add New Person
    </button>

    <!-- Create Person Modal -->
    <div class="modal fixed inset-0 flex items-center justify-center z-50 hidden" id="createPersonModal">
        <div class="relative w-full max-w-lg pointer-events-auto">
            <div class="border-none shadow-lg relative flex flex-col w-full bg-white bg-clip-padding rounded-md outline-none text-current">
                <div class="flex items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium text-gray-800">Add New Person</h5>
                    <button onclick="closeModal('createPersonModal')" class="text-gray-400 hover:text-gray-500" aria-label="Close">✖️</button>
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

                    <form action="{{ route('admin.person.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                            <input type="text" id="name" name="name" required
                                class="block w-full px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="mb-3">
                            <label for="bio" class="block text-gray-700 font-bold mb-2">Bio</label>
                            <textarea id="bio" name="bio"
                                class="block w-full px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="photo_url" class="block text-gray-700 font-bold mb-2">Photo URL</label>
                            <input type="url" id="photo_url" name="photo_url"
                                class="block w-full px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Person</button>
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
                    <th scope="col" class="py-3 px-6">Bio</th>
                    <th scope="col" class="py-3 px-6">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($people as $person)
                <tr class="border-b bg-gray-800 border-gray-700">
                    <th scope="row" class="py-4 px-6 font-medium text-white">{{ $person->id }}</th>
                    <td class="py-4 px-6">{{ $person->name }}</td>
                    <td class="py-4 px-6">{{ \Illuminate\Support\Str::limit($person->bio, 100) }}</td>
                    <td class="py-4 px-6 flex space-x-2">
                        <!-- Trigger modal button for Edit -->
                        <button onclick="openModal('editPersonModal{{ $person->id }}')" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </button>
                        <!-- Edit Person Modal -->
                        <div class="modal fixed inset-0 flex items-center justify-center z-50 hidden" id="editPersonModal{{ $person->id }}">
                            <div class="relative w-full max-w-lg pointer-events-auto">
                                <div class="border-none shadow-lg relative flex flex-col w-full bg-white bg-clip-padding rounded-md outline-none text-current">
                                    <div class="flex items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                                        <h5 class="text-xl font-medium text-gray-800">Edit Person: {{ $person->name }}</h5>
                                        <button onclick="closeModal('editPersonModal{{ $person->id }}')" class="text-gray-400 hover:text-gray-500" aria-label="Close">✖️</button>
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
                                        <form action="{{ route('admin.person.update', $person->id) }}" method="POST" class="space-y-4">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="name{{ $person->id }}" class="block text-gray-700 font-bold mb-2">Name</label>
                                                <input type="text" id="name{{ $person->id }}" name="name" value="{{ $person->name }}" required
                                                    class="block w-full px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            </div>
                                            <div class="mb-3">
                                                <label for="bio{{ $person->id }}" class="block text-gray-700 font-bold mb-2">Bio</label>
                                                <textarea id="bio{{ $person->id }}" name="bio"
                                                    class="block w-full px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $person->bio }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="photo_url{{ $person->id }}" class="block text-gray-700 font-bold mb-2">Photo URL</label>
                                                <input type="url" id="photo_url{{ $person->id }}" name="photo_url" value="{{ $person->photo_url }}" required
                                                    class="block w-full px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            </div>
                                            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Person</button>
                                        </form>
                                        <form action="{{ route('admin.person.destroy', $person->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this person?');" class="mt-2">
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
