<nav class="bg-gray-800 border-b border-gray-700 px-2 sm:px-4 py-2.5">
    <div class="container mx-auto flex flex-wrap justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('index') }}" class="flex items-center">
            <img src="{{ asset('images/logo-small.png') }}" alt="Logo" class="mr-3 h-9">
        </a>

        <!-- Mobile menu button -->
        <button class="navbar-toggler inline-flex items-center p-2 text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-700" type="button" id="mobile-menu-button">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>

        <!-- Navbar content -->
        <div class="hidden w-full md:block md:w-auto" id="navbarSupportedContent">
            <div class="flex flex-col md:flex-row md:space-x-10 w-full">
                <!-- Search form -->
                <form class="flex-grow flex items-center space-x-2" action="{{ route('search') }}" method="GET">
                    <input class="form-input flex-grow rounded-l-md" type="search" placeholder="Search" aria-label="Search" name="search" value="{{ request('search') }}">
                    <select class="form-select rounded-none" name="searchType">
                        <option value="content"{{ request('searchType') == 'content' ? ' selected' : '' }}>Content</option>
                        <option value="people"{{ request('searchType') == 'people' ? ' selected' : '' }}>People</option>
                    </select>
                    <button class="btn bg-green-500 hover:bg-green-700 text-white px-3 py-2 rounded-r-md transition duration-300" type="submit">Search</button>
                </form>
                <!-- Navigation links -->
                <ul class="flex-grow flex flex-col md:flex-row md:justify-end space-y-4 md:space-y-0 md:space-x-4">
                    <li>
                        <a class="text-white hover:bg-gray-700 px-3 py-2 rounded-md" href="{{ route('index') }}">Home</a>
                    </li>
                    <li>
                        <a class="text-white hover:bg-gray-700 px-3 py-2 rounded-md" href="{{ route('people') }}">People</a>
                    </li>
                    <li>
                        <button class="text-white hover:bg-gray-700 px-3 py-2 rounded-md" id="dropdownMoviesButton">Movies & Shows</button>
                        <!-- Dropdown content -->
                        <ul class="hidden bg-gray-800" id="moviesDropdown">
                            <li><a href="{{ route('contents') }}?type=movie">Movies</a></li>
                            <li><a href="{{ route('contents') }}?type=tv_show">TV Shows</a></li>
                            <li><a href="{{ route('contents') }}">Show all</a></li>
                        </ul>
                    </li>
                    <li>
                        <button class="text-white hover:bg-gray-700 px-3 py-2 rounded-md" id="dropdownGenresButton">Genres</button>
                        <!-- Dropdown content -->
                        <ul class="hidden bg-gray-800" id="genresDropdown">
                            @foreach ($genres as $genre)
                                <li><a href="{{ route('contents') }}?genre[]={{ $genre->name }}">{{ $genre->name }}</a></li>
                            @endforeach
                            <li><a href="{{route('genres')}}">All Genres</a></li>
                        </ul>
                    </li>
                    @if (Auth::check())
                        <li>
                            <a class="text-white hover:bg-gray-700 px-3 py-2 rounded-md" href="{{ route('watchlist') }}">My Watchlist</a>
                        </li>
                    @endif
                    <!-- Conditional Admin Panel -->
                    @can('manage-users')
                        <li>
                            <button class="text-white hover:bg-gray-700 px-3 py-2 rounded-md" id="adminDropdownButton">Admin Panel</button>
                            <ul class="hidden bg-gray-800" id="adminDropdown">
                                <li><a href="{{ route('admin.users.index') }}">User Settings</a></li>
                                <li><a href="{{ route('admin.contents.index') }}">Manage Contents</a></li>
                                <li><a href="{{ route('admin.people.index') }}">Manage People</a></li>
                                <li><a href="{{ route('admin.genres.index') }}">Manage Genres</a></li>
                            </ul>
                        </li>
                    @endcan
                    @guest
                        <li>
                            <a class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li>
                            <a class="bg-white hover:bg-gray-100 text-green-500 py-2 px-4 rounded border border-green-500" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @else
                        <li>
                            <a class="bg-white hover:bg-gray-100 text-green-500 py-2 px-4 rounded border border-green-500" href="{{ route('user.profile', Auth::user()->username) }}">{{ __('Profile') }}</a>
                        </li>
                        <li>
                            <a class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded" href="{{ route('logout') }}"
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
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
      // Toggle dropdowns
      const toggleDropdown = (buttonId, dropdownId) => {
        const button = document.getElementById(buttonId);
        const dropdown = document.getElementById(dropdownId);
        button.addEventListener('click', () => {
          dropdown.classList.toggle('hidden');
        });
      };
  
      toggleDropdown('dropdownMoviesButton', 'moviesDropdown');
      toggleDropdown('dropdownGenresButton', 'genresDropdown');
      toggleDropdown('adminDropdownButton', 'adminDropdown');
  
      // Mobile menu toggle
      const mobileMenuButton = document.getElementById('mobile-menu-button');
      const navbarContent = document.getElementById('navbarSupportedContent');
      mobileMenuButton.addEventListener('click', () => {
        navbarContent.classList.toggle('hidden');
      });
    });
  </script>
