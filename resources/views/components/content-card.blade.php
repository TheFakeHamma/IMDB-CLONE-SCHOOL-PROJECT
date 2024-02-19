<div class="card" style="width: 18rem;">
    @if($photoUrl)
        <img src="{{ $photoUrl }}" class="card-img-top" alt="{{ $title }}">
    @endif
    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>
        <p class="card-text">{{ $releaseDate->format('Y') }}</p>
        <a href="#" class="btn btn-primary">More Details</a>
    </div>
</div>
