<div class="col mb-4">
    <div class="card h-100" style="width: 15rem;">
        @if ($photoUrl)
            <img src="{{ $photoUrl }}" class="card-img-top" alt="{{ $name }}">
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $name }}</h5>
            @if ($bio)
                <p class="card-text">{{ \Illuminate\Support\Str::limit($bio, 100) }}</p>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{route('people.show', ['id' => $id]) }}" class="btn btn-primary">View Profile</a>
        </div>
    </div>
</div>
