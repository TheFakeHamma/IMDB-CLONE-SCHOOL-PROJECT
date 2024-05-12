<nav class="bg-[#03001D]">
    <div class="mx-auto flex items-center justify-between px-4 py-2">
        <a href="{{ route('index') }}" class="flex items-center space-x-3">
            <img src="{{ asset('images/logo-small.png') }}" alt="filmsphere logo" />
        </a>
        <!-- Search Form -->
        <form class="flex-grow mx-5 flex items-center" action="{{ route('search') }}" method="GET">
            <div class="flex w-1/2">
                <input type="search" placeholder="Search..." name="search" value="{{ request('search') }}"
                    class="w-full px-3 h-10 rounded-l bg-white border border-gray-600 text-white focus:outline-none focus:border-blue-500">
                <button type="submit" class="bg-[#FF3131] text-white rounded-r px-3 py-1">Search</button>
            </div>
            <select name="searchType"
                class="ml-3 h-10 bg-gray-800 border border-gray-600 text-white rounded px-3 py-1 focus:outline-none focus:border-blue-500 tracking-wider">
                <option value="content"{{ request('searchType') == 'content' ? ' selected' : '' }}>Content</option>
                <option value="people"{{ request('searchType') == 'people' ? ' selected' : '' }}>People</option>
            </select>
        </form>
        <!-- Navigation Links -->
        <ul class="flex items-center space-x-8">
            <li>
                <a href="{{ route('index') }}" class="text-white hover:text-red-500">Home</a>
            </li>
            <li>
                <a href="{{route('people')}}" class="text-white hover:text-red-500">People</a>
            </li>
            <li>
                <button id="contentDropdownLink" data-dropdown-toggle="contentDropdown"
                    class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-red-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Movies
                    & Tv Shows
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg></button>
                <!-- Dropdown Menu -->
                <div id="contentDropdown"
                    class="hidden absolute bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600 z-50">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-400">
                        <li>
                            <a href="{{ route('contents') }}?type=movie"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Movies</a>
                        </li>
                        <li>
                            <a href="{{ route('contents') }}?type=tv_show"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tv
                                Shows</a>
                        </li>
                    </ul>
                    <div class="py-1">
                        <a href="{{ route('contents') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Show
                            All</a>
                    </div>
                </div>
            </li>
            <li>
                <button id="genresDropdownLink" data-dropdown-toggle="genresDropdown"
                    class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-red-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Genres
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg></button>
                <!-- Dropdown Menu -->
                <div id="genresDropdown"
                    class="hidden absolute bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600 z-50">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-400">
                        @foreach ($topGenres as $genre)
                            <li>
                                <a href="{{ route('contents') }}?genre[]={{ $genre->name }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $genre->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="py-1">
                        <a href="{{ route('genres') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">All
                            Genres</a>
                    </div>
                </div>
            </li>
            @if (Auth::check())
                <li>
                    <a href="{{ route('watchlist') }}" class="text-white hover:text-red-500">My Watchlist</a>
                </li>
            @endif
            @can('manage-users')
                <li>
                    <button id="adminDropdownLink" data-dropdown-toggle="adminDropdown"
                        class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-red-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Admin
                        Panel
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg></button>
                    <!-- Dropdown Menu -->
                    <div id="adminDropdown"
                        class="hidden absolute bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600 z-50">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-400">
                            <li>
                                <a href="{{ route('admin.users.index') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">User
                                    Settings</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.contents.index') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Manage
                                    Contents</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.people.index') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Manage
                                    People</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.genres.index') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Manage
                                    Genres</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan
            @guest
                <a href="{{ route('register') }}"
                    class="border border-white text-white bg-[#03001D] hover:bg-[#1f3034] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-[#03001D] dark:hover:bg-[#1f3034] dark:focus:ring-blue-800">Register</a>
                <a href="{{ route('login') }}"
                    class="border border-transparent text-white bg-[#225560] hover:bg-[#1f3034] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-[#225560] dark:hover:bg-[#1f3034] dark:focus:ring-blue-800">Login</a>
            @else
                <li>
                    <a href="{{ route('user.profile', Auth::user()->username) }}"
                        class="text-white hover:text-red-500">Profile</a>
                </li>
                <li>
                    <a class="text-white bg-[#FF3131] hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </li>
            @endguest
        </ul>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggles = document.querySelectorAll('[data-dropdown-toggle]');
        let activeDropdown = null;

        dropdownToggles.forEach(function(toggle) {
            toggle.addEventListener('click', function(event) {
                const targetDropdownId = toggle.getAttribute('data-dropdown-toggle');
                const targetDropdown = document.getElementById(targetDropdownId);

                if (activeDropdown && activeDropdown !== targetDropdown) {
                    activeDropdown.classList.add('hidden');
                }

                targetDropdown.classList.toggle('hidden');
                activeDropdown = targetDropdown.classList.contains('hidden') ? null :
                    targetDropdown;

                event.stopPropagation();
            });
        });

        document.addEventListener('click', function() {
            if (activeDropdown) {
                activeDropdown.classList.add('hidden');
                activeDropdown = null;
            }
        });

        document.querySelectorAll('.dropdown-menu').forEach(function(dropdown) {
            dropdown.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        });
    });
</script>
