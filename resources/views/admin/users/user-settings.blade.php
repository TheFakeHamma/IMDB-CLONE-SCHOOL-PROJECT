@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>User Management</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            <!-- Trigger modal button -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editUserModal{{ $user->id }}">
                                Edit
                            </button>

                            <!-- Edit User Modal -->
                            <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
                                aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit User:
                                                {{ $user->username }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
                                                class="mb-3">
                                                @csrf
                                                @method('PUT')

                                                <div class="mb-3">
                                                    <label for="email{{ $user->id }}" class="form-label">Email</label>
                                                    <input type="email" class="form-control"
                                                        id="email{{ $user->id }}" name="email"
                                                        value="{{ $user->email }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="role{{ $user->id }}" class="form-label">Role</label>
                                                    <select class="form-select" id="role{{ $user->id }}"
                                                        name="role">
                                                        <option
                                                            value="user"{{ $user->role == 'user' ? ' selected' : '' }}>
                                                            User</option>
                                                        <option
                                                            value="admin"{{ $user->role == 'admin' ? ' selected' : '' }}>
                                                            Admin</option>
                                                    </select>
                                                </div>
                                                <!-- Buttons Container -->
                                                <div class="d-flex justify-content-start">
                                                    <!-- Update Button -->
                                                    <button type="submit" class="btn btn-primary me-2">Update User</button>
                                                </div>
                                            </form>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Are you sure you want to delete this person?');">
                                                @csrf
                                                @method('DELETE')
                                                <!-- Delete Button -->
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
