<footer class="text-center text-lg-start bg-dark text-muted">
    <div class="container text-center text-md-start mt-5 text-light">
        <div class="row mt-3">
            <!-- Logo and introduction -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4 mt-4">
                <img src="{{ asset('images/logo-small.png') }}" alt="FilmSphere Logo" width="50%">
                <p class="text-uppercase fw-bold mt-3">Connecting Cinema</p>
                <p>Discover your next favorite movie or TV show with FilmSphere.</p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4 mt-4">
                <h6 class="text-uppercase fw-bold mb-4">Quick Links</h6>
                <p>
                    <a href="{{ route('index') }}" class="text-light">Home</a>
                </p>
                <p>
                    <a href="{{ route('contents') }}" class="text-light">Movies & Shows</a>
                </p>
                <p>
                    <a href="{{ route('people') }}" class="text-light">People</a>
                </p>
                <p>
                    <a href="{{ route('genres') }}" class="text-light">Genres</a>
                </p>
                @if (Auth::check())
                    <p>
                        <a href="{{ route('watchlist') }}" class="text-light">My Watchlist</a>
                    </p>
                @endif
            </div>

            <!-- Genres -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4 mt-4">
                <h6 class="text-uppercase fw-bold mb-4">
                    Genres
                </h6>
                @php $displayGenresLimit = 4; @endphp
                @foreach ($genres->take($displayGenresLimit) as $genre)
                    <p>
                        <a class="text-light"
                            href="{{ route('contents') }}?genre[]={{ $genre->name }}">{{ $genre->name }}</a>
                    </p>
                @endforeach
            </div>

            <!-- Contact and social -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 mt-4">
                <h6 class="text-uppercase fw-bold mb-4">Contact Us</h6>
                <p><i class="fas fa-home me-3"></i> 123, Street Name, City, SE</p>
                <p><i class="fas fa-envelope me-3"></i> info@example.com</p>
                <p><i class="fas fa-phone me-3"></i> + 00 000 000 00</p>
                <p><i class="fas fa-print me-3"></i> + 00 000 000 00</p>
            </div>
        </div>
    </div>

    <div class="text-center p-4 text-light">
        © 2024 Copyright: <a class="text-reset fw-bold" href="{{ route('index') }}">imdb-clone-school-project-production.up.railway.app</a>
    </div>
</footer>
