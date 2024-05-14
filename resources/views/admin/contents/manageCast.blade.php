@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen py-8">
    <div class="w-full max-w-6xl bg-white bg-opacity-90 rounded-lg shadow-lg p-8">
        <a href="{{ route('admin.contents.index') }}" class="text-blue-700 hover:text-blue-900 font-semibold mb-3 inline-block">Back to Content Management</a>
        <h1 class="text-2xl font-bold mb-6 text-gray-900">Manage Cast for: {{ $content->title }}</h1>

        <div class="flex flex-wrap -mx-2">
            <div class="w-full md:w-1/2 px-2 mb-6">
                <form action="{{ route('admin.manage.cast', $content->id) }}" method="GET" class="mb-4">
                    <div class="flex items-center">
                        <input type="text" class="w-full mr-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Search current cast..."
                            name="search_current_cast" value="{{ request('search_current_cast') }}">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Search</button>
                        <a href="{{ route('admin.manage.cast', $content->id) }}" class="ml-2 text-gray-500">Clear</a>
                    </div>
                </form>
                <h2 class="text-lg font-semibold mb-2">Current Cast</h2>
                <div class="flex flex-wrap -mx-1">
                    @foreach ($currentCast as $person)
                        <div class="w-1/2 p-1">
                            <div class="bg-white rounded shadow overflow-hidden">
                                <img src="{{ $person->photo_url }}" class="w-full h-48 object-cover" alt="{{ $person->name }}"
                                    onerror="this.onerror=null; this.src='{{ asset('path/to/default-image.jpg') }}'">
                                <div class="p-4">
                                    <h5 class="font-bold">{{ $person->name }}</h5>
                                    <p class="text-sm">Role: {{ $person->pivot->role }}</p>
                                    <div class="flex space-x-2 mt-3">
                                        <button onclick="openModal('editRoleModal{{ $person->id }}')" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded text-xs">
                                            Edit Role
                                        </button>
                                        <form method="POST"
                                            action="{{ route('admin.cast.remove', ['content' => $content->id, 'person' => $person->id]) }}"
                                            class="mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-xs">Remove from Cast</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Edit Role Modal -->
                            <div class="hidden modal" id="editRoleModal{{ $person->id }}">
                                <div class="modal fixed inset-0 flex items-center justify-center z-50">
                                    <div class="modal-dialog relative w-full max-w-lg pointer-events-none">
                                        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                                            <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                                                <h5 class="text-xl font-medium leading-normal text-gray-800">Edit
                                                    Role: {{ $person->name }}</h5>
                                                <button onclick="closeModal('editRoleModal{{ $person->id }}')" class="text-gray-400 hover:text-gray-500" aria-label="Close">✖️</button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <form method="POST"
                                                    action="{{ route('admin.cast.update', ['content' => $content->id, 'person' => $person->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <select name="role" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                            <option value="actor"
                                                                {{ $person->pivot->role == 'actor' ? 'selected' : '' }}>
                                                                Actor</option>
                                                            <option value="director"
                                                                {{ $person->pivot->role == 'director' ? 'selected' : '' }}>
                                                                Director</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Update Role</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 flex justify-center">
                    {{ $currentCast->links('vendor.pagination.tailwind') }}
                </div>
            </div>
            <div class="w-full md:w-1/2 px-2">
                <form action="{{ route('admin.manage.cast', $content->id) }}" method="GET" class="mb-4">
                    <div class="flex items-center">
                        <input type="text" class="w-full mr-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Search available people..."
                            name="search_add_cast" value="{{ request('search_add_cast') }}">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Search</button>
                        <a href="{{ route('admin.manage.cast', $content->id) }}" class="ml-2 text-gray-500">Clear</a>
                    </div>
                </form>
                <h2 class="text-lg font-semibold mb-2">Add to Cast</h2>
                <div class="flex flex-wrap -mx-1">
                    @foreach ($allPeople as $person)
                        <div class="w-1/2 p-1">
                            <div class="bg-white rounded shadow overflow-hidden">
                                <img src="{{ $person->photo_url }}" class="w-full h-48 object-cover" alt="{{ $person->name }}"
                                    onerror="this.onerror=null; this.src='{{ asset('path/to/default-image.jpg') }}'">
                                <div class="p-4">
                                    <h5 class="card-title font-bold">{{ $person->name }}</h5>
                                    <form method="POST" action="{{ route('admin.cast.add', $content->id) }}">
                                        @csrf
                                        <input type="hidden" name="person_id" value="{{ $person->id }}">
                                        <select name="role" class="w-full mt-1 mb-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="actor">Actor</option>
                                            <option value="director">Director</option>
                                        </select>
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Add to Cast</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 flex justify-center">
                    {{ $allPeople->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        </div>
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
