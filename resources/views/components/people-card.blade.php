<div class="col mb-4">
    <div class="card h-100" style="width: 15rem;">
        @if ($photoUrl)
            <img src="{{ $photoUrl }}" class="card-img-top" alt="{{ $name }}">
        @endif
        <div class="card-body d-flex flex-column justify-content-between">
            <div>
                <h5 class="card-title">{{ $name }}</h5>
                <p class="card-text">
                    {{ strlen($bio) > 100 ? substr($bio, 0, 100) . '...' : $bio }}
                </p>
                @if (isset($role))
                    <footer class="blockquote-footer mt-2">Role - {{ $role }}</footer>
                @endif
            </div>
            <div>
                <a href="#" class="btn btn-danger mt-2">More Details</a>
            </div>
        </div>
    </div>
</div>
