@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold text-white my-6">User Management</h1>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left  text-gray-400">
                <thead class="text-xs  uppercase  bg-gray-700 text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">#</th>
                        <th scope="col" class="py-3 px-6">Username</th>
                        <th scope="col" class="py-3 px-6">Email</th>
                        <th scope="col" class="py-3 px-6">Role</th>
                        <th scope="col" class="py-3 px-6">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class=" border-b bg-gray-800 border-gray-700">
                            <th scope="row" class="py-4 px-6 font-medium  whitespace-nowrap text-white">
                                {{ $user->id }}</th>
                            <td class="py-4 px-6">{{ $user->username }}</td>
                            <td class="py-4 px-6">{{ $user->email }}</td>
                            <td class="py-4 px-6">{{ ucfirst($user->role) }}</td>
                            <td class="py-4 px-6">
                                <!-- Trigger modal button -->
                                <button onclick="openModal('editUserModal{{ $user->id }}')"
                                    class="text-white  focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
                                    Edit
                                </button>

                                <!-- Edit User Modal -->
                                <div id="editUserModal{{ $user->id }}"
                                    class="modal fixed inset-0 flex items-center justify-center z-50 hidden">
                                    <div class="modal-dialog relative w-[30rem] pointer-events-none">
                                        <div
                                            class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                                            <div
                                                class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                                                <h5 class="text-xl font-medium leading-normal text-gray-800"
                                                    id="editUserModalLabel{{ $user->id }}">Edit User:
                                                    {{ $user->username }}</h5>
                                                <button type="button" class="close-modal"
                                                    data-target="editUserModal{{ $user->id }}"
                                                    aria-label="Close">✖️</button>
                                            </div>
                                            <div class="modal-body relative p-4">
                                                <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
                                                    class="space-y-6">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="form-group mb-6">
                                                        <label for="email{{ $user->id }}"
                                                            class="form-label inline-block mb-2 text-gray-700">Email</label>
                                                        <input type="email"
                                                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                            id="email{{ $user->id }}" name="email"
                                                            value="{{ $user->email }}" required>
                                                    </div>

                                                    <div class="form-group mb-6">
                                                        <label for="role{{ $user->id }}"
                                                            class="form-label inline-block mb-2 text-gray-700">Role</label>
                                                        <select
                                                            class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                            id="role{{ $user->id }}" name="role">
                                                            <option
                                                                value="user"{{ $user->role == 'user' ? ' selected' : '' }}>
                                                                User</option>
                                                            <option
                                                                value="admin"{{ $user->role == 'admin' ? ' selected' : '' }}>
                                                                Admin</option>
                                                        </select>
                                                    </div>
                                                    <!-- Buttons Container -->
                                                    <div class="flex space-x-2">
                                                        <!-- Update Button -->
                                                        <button type="submit"
                                                            class="text-white focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Update
                                                            User</button>
                                                        <!-- Delete Button -->
                                                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this person?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-red-500 hover:bg-red-600 focus:ring-red-700">Delete</button>
                                                        </form>
                                                    </div>
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

        document.querySelectorAll('.close-modal').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById(this.getAttribute('data-target')).style.display = 'none';
            });
        });
    </script>
@endsection
