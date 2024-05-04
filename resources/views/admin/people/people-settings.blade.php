@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold my-6">People Management</h1>
    <!-- Button to trigger modal -->
    <button onclick="openModal('createPersonModal')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
        Add New Person
    </button>

    <!-- Create Person Modal -->
    <div class="hidden modal" id="createPersonModal">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800">Add New Person</h5>
                    <button onclick="closeModal('createPersonModal')" class="text-gray-400 hover:text-gray-500" aria-label="Close">✖️</button>
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

                    <form action="{{ route('admin.person.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-input mt-1 block w-full" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-textarea mt-1 block w-full" id="bio" name="bio"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="photo_url" class="form-label">Photo URL</label>
                            <input type="url" class="form-input mt-1 block w-full" id="photo_url" name="photo_url">
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Person</button>
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
                <th scope="col" class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Bio</th>
                <th scope="col" class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($people as $person)
            <tr>
                <th scope="row" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $person->id }}</th>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $person->name }}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ \Illuminate\Support\Str::limit($person->bio, 100) }}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <!-- Trigger modal button for Edit -->
                    <button onclick="openModal('editPersonModal{{ $person->id }}')" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Edit
                    </button>
                    <!-- Edit Person Modal -->
                    <div class="hidden modal" id="editPersonModal{{ $person->id }}">
                        <div class="modal-dialog relative w-auto pointer-events-none">
                            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                                <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                                    <h5 class="text-xl font-medium leading-normal text-gray-800">Edit Person: {{ $person->name }}</h5>
                                    <button onclick="closeModal('editPersonModal{{ $person->id }}')" class="text-gray-400 hover:text-gray-500" aria-label="Close">✖️</button>
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
                                    <form action="{{ route('admin.person.update', $person->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="name{{ $person->id }}" class="form-label">Name</label>
                                            <input type="text" class="form-input mt-1 block w-full" id="name{{ $person->id }}"
                                                name="name" value="{{ $person->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="bio{{ $person->id }}" class="form-label">Bio</label>
                                            <textarea class="form-textarea mt-1 block w-full" id="bio{{ $person->id }}"
                                                name="bio">{{ $person->bio }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="photo_url{{ $person->id }}" class="form-label">Photo URL</label>
                                            <input type="url" class="form-input mt-1 block w-full" id="photo_url{{ $person->id }}"
                                                name="photo_url" value="{{ $person->photo_url }}" required>
                                        </div>
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Person</button>
                                    </form>
                                    <form action="{{ route('admin.person.destroy', $person->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this person?');">
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
