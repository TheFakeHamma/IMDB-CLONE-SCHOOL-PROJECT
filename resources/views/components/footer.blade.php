<footer class="text-center lg:text-left bg-gray-800 text-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Logo and introduction -->
            <div class="mx-auto lg:mx-0">
                <img src="{{ asset('images/logo-small.png') }}" alt="FilmSphere Logo" class="w-1/2 mx-auto lg:mx-0">
                <p class="font-bold text-lg mt-3">Connecting Cinema</p>
                <p>Discover your next favorite movie or TV show with FilmSphere.</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h6 class="font-bold text-lg mb-4">Quick Links</h6>
                <p><a href="{{ route('index') }}" class="hover:text-gray-300">Home</a></p>
                <p><a href="{{ route('contents') }}" class="hover:text-gray-300">Movies & Shows</a></p>
                <p><a href="{{ route('people') }}" class="hover:text-gray-300">People</a></p>
                <p><a href="{{ route('genres') }}" class="hover:text-gray-300">Genres</a></p>
                @if (Auth::check())
                    <p><a href="{{ route('watchlist') }}" class="hover:text-gray-300">My Watchlist</a></p>
                @endif
            </div>

            <!-- Genres -->
            <div>
                <h6 class="font-bold text-lg mb-4">Genres</h6>
                @php $displayGenresLimit = 4; @endphp
                @foreach ($genres->take($displayGenresLimit) as $genre)
                    <p><a href="{{ route('contents') }}?genre[]={{ $genre->name }}" class="hover:text-gray-300">{{ $genre->name }}</a></p>
                @endforeach
            </div>

            <!-- Contact and social -->
            <div>
                <h6 class="font-bold text-lg mb-4">Contact Us</h6>
                <p><i class="fas fa-home mr-2"></i> 123, Street Name, City, SE</p>
                <p><i class="fas fa-envelope mr-2"></i> info@example.com</p>
                <p><i class="fas fa-phone mr-2"></i> + 00 000 000 00</p>
                <p><i class="fas fa-print mr-2"></i> + 00 000 000 00</p>
            </div>
        </div>
    </div>

    <div class="text-center p-4 bg-gray-700">
        © 2024 Copyright: 
        <a href="{{ route('index') }}" class="font-bold hover:text-gray-300">imdb-clone-school-project-production.up.railway.app</a>
    </div>
</footer>
