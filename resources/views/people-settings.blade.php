@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>People Management</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Bio</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($people as $person)
                    <tr>
                        <th scope="row">{{ $person->id }}</th>
                        <td>{{ $person->name }}</td>
                        <td>{{ $person->bio }}</td>
                        <td>
                            <!-- Trigger modal button for Edit -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editPersonModal{{ $person->id }}">
                                Edit
                            </button>
                            <!-- Edit User Modal -->
                            <div class="modal fade" id="editPersonModal{{ $person->id }}" tabindex="-1"
                                aria-labelledby="editPersonModalLabel{{ $person->id }}" aria-hidden="true">

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editPersonModalLabel{{ $person->id }}">Edit
                                                Person:
                                                {{ $person->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.person.update', $person->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="mb-3">
                                                    <label for="name{{ $person->id }}" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="name{{ $person->id }}"
                                                        name="name" value="{{ $person->name }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="bio{{ $person->id }}" class="form-label">Bio</label>
                                                    <input type="text" class="form-control" id="bio{{ $person->id }}"
                                                        name="bio" value="{{ $person->bio }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="photo_url{{ $person->id }}" class="form-label">Photo
                                                        URL</label>
                                                    <input type="url" class="form-control"
                                                        id="photo_url{{ $person->id }}" name="photo_url"
                                                        value="{{ $person->photo_url }}" required>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Update Person</button>
                                                <!-- Trigger button for Delete -->
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
