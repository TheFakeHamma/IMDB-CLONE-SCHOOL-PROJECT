<div class="col mb-4">
    <div class="card h-100" style="width: 15rem;">
        @if ($photoUrl)
            <img src="{{ $photoUrl }}" class="card-img-top" alt="{{ $title }}">
        @endif
        <div class="card-body d-flex flex-column justify-content-between">
            <div>
                <h5 class="card-title">{{ $title }}</h5>
                <footer class="blockquote-footer mt-2">Release date {{ $releaseDate->format('Y') }}</footer>
                @if ($averageRating)
                    <div class="rating">
                        @for ($i = 0; $i < 5; $i++)
                            @if (is_numeric($averageRating) && $i < round($averageRating))
                                <i class="fas fa-star" style="color: gold;"></i>
                            @else
                                <i class="far fa-star" style="color: gold;"></i>
                            @endif
                        @endfor
                    </div>
                @endif
            </div>
            <div>
                <a href="{{ route('content.show', ['id' => $id]) }}" class="btn btn-danger mt-2">More Details</a>
            </div>
        </div>
    </div>
</div>
