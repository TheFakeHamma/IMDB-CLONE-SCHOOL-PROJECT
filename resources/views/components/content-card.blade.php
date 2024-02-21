<div class="col mb-4">
    <div class="card h-100" style="width: 15rem;">
        @if ($photoUrl)
            <img src="{{ $photoUrl }}" class="card-img-top" alt="{{ $title }}">
        @endif
        <div class="card-body d-flex flex-column justify-content-between">
            <div>
                <h5 class="card-title">{{ $title }}</h5>
                <footer class="blockquote-footer mt-2">Release date {{$releaseDate->format('Y')}}</footer>
            </div>
            <div>
                <a href="#" class="btn btn-danger mt-2">More Details</a>
            </div>
        </div>
    </div>
</div>
