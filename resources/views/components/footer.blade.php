<footer class="bg-[#B6B6B6] shadow">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="{{route('index')}}" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/logo-small.png') }}" alt="filmsphere logo" />
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm text-black sm:mb-0">
                <li>
                    <a href="{{ route('index') }}" class="hover:underline mr-4 md:mr-6">Home</a>
                </li>
                <li>
                    <a href="{{ route('contents') }}" class="hover:underline mr-4 md:mr-6">Movies & Tv Shows</a>
                </li>
                <li>
                    <a href="{{ route('genres') }}" class="hover:underline mr-4 md:mr-6">Genres</a>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
        <span class="block text-sm text-black sm:text-center">© 2024 <a href="https://flowbite.com/" class="hover:underline">FilmSphere</a>. All Rights Reserved.</span>
    </div>
</footer>