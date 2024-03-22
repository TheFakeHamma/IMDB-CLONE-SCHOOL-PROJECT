@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('admin.contents.index') }}" class="btn btn-secondary mb-3">Back to Content Management</a>
        <h1>Manage Cast for: {{ $content->title }}</h1>
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('admin.manage.cast', $content->id) }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search current cast..."
                            name="search_current_cast" value="{{ request('search_current_cast') }}">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                        <a href="{{ route('admin.manage.cast', $content->id) }}" class="btn btn-outline-secondary">Clear</a>
                    </div>
                </form>
                <h2>Current Cast</h2>
                <div class="row">
                    @foreach ($content->people as $person)
                        <div class="col-sm-6">
                            <div class="card mb-3">
                                <img src="{{ $person->photo_url }}" class="card-img-top" alt="{{ $person->name }}"
                                    onerror="this.onerror=null; this.src='{{ asset('path/to/default-image.jpg') }}'">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $person->name }}</h5>
                                    <p>Role: {{ $person->pivot->role }}</p>
                                    <!-- Trigger/Edit Role Modal -->
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editRoleModal{{ $person->id }}">
                                        Edit Role
                                    </button>
                                    <!-- Edit Role Modal -->
                                    <div class="modal fade" id="editRoleModal{{ $person->id }}" tabindex="-1"
                                        aria-labelledby="editRoleModalLabel{{ $person->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editRoleModalLabel{{ $person->id }}">Edit
                                                        Role: {{ $person->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST"
                                                        action="{{ route('admin.cast.update', ['content' => $content->id, 'person' => $person->id]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <select name="role" class="form-control">
                                                                <option value="actor"
                                                                    {{ $person->pivot->role == 'actor' ? 'selected' : '' }}>
                                                                    Actor</option>
                                                                <option value="director"
                                                                    {{ $person->pivot->role == 'director' ? 'selected' : '' }}>
                                                                    Director</option>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Update Role</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Remove from Cast Button -->
                                    <form method="POST"
                                        action="{{ route('admin.cast.remove', ['content' => $content->id, 'person' => $person->id]) }}"
                                        class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Remove from Cast</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 d-flex justify-content-center">
                    {{ $currentCast->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
            <div class="col-md-6">
                <form action="{{ route('admin.manage.cast', $content->id) }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search available people..."
                            name="search_add_cast" value="{{ request('search_add_cast') }}">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                        <a href="{{ route('admin.manage.cast', $content->id) }}"
                            class="btn btn-outline-secondary">Clear</a>
                    </div>
                </form>
                <h2>Add to Cast</h2>
                <div class="row">
                    @foreach ($allPeople as $person)
                        <div class="col-sm-6">
                            <div class="card mb-3">
                                <img src="{{ $person->photo_url }}" class="card-img-top" alt="{{ $person->name }}"
                                    onerror="this.onerror=null; this.src='{{ asset('path/to/default-image.jpg') }}'">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $person->name }}</h5>
                                    <form method="POST" action="{{ route('admin.cast.add', $content->id) }}">
                                        @csrf
                                        <input type="hidden" name="person_id" value="{{ $person->id }}">
                                        <select name="role" class="form-control">
                                            <option value="actor">Actor</option>
                                            <option value="director">Director</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary mt-2">Add to Cast</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 d-flex justify-content-center">
                    {{ $allPeople->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection