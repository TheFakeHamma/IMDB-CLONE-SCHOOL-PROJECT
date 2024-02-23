<div class="card mt-3">
    <div class="card-header">
        @for ($i = 0; $i < 5; $i++)
            @if ($i < $review->rating)
                <i class="fas fa-star" style="color: gold;"></i>
            @else
                <i class="far fa-star" style="color: gold;"></i>
            @endif
        @endfor
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <p>{{ $review->review }}</p>
            <footer class="blockquote-footer">
                <cite title="Source Title">{{ $review->user->username }}</cite>
            </footer>
        </blockquote>
    </div>
</div>