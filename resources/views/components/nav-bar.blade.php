<nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900">
    <div class="container-fluid max-w-7xl mx-auto flex flex-wrap justify-between items-center">
        <!-- Logo -->
        <a class="flex items-center" href="{{ route('index') }}">
            <img src="{{ asset('images/logo-small.png') }}" alt="Logo" class="mr-3 h-6 sm:h-9">
        </a>

        <!-- Mobile menu button -->
        <button class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar content -->
        <div class="hidden w-full md:block md:w-auto" id="navbarSupportedContent">
            <div class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
                <!-- Search form -->
                <form class="flex-grow mr-3" role="search" action="{{ route('search') }}" method="GET">
                    <div class="input-group relative flex items-stretch w-full">
                        <input class="form-input rounded-l-md" type="search" placeholder="Search" aria-label="Search" name="search" value="{{ request('search') }}">
                        <select class="form-select block w-20 rounded-none rounded-r-md" name="searchType">
                            <option value="content"{{ request('searchType') == 'content' ? ' selected' : '' }}>Content</option>
                            <option value="people"{{ request('searchType') == 'people' ? ' selected' : '' }}>People</option>
                        </select>
                        <button class="btn inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out ml-1" type="submit">Search</button>
                    </div>
                </form>
                <!-- Navigation links -->
                <div class="flex flex-grow justify-end">
                    <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
                        <li>
                            <a class="nav-link block py-2 pr-4 pl-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white" href="{{ route('index') }}" aria-current="page">Home</a>
                        </li>
                        <li>
                            <a class="nav-link block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent" href="{{ route('people') }}">People</a>
                        </li>
                        <!-- More navigation items -->
                    </ul>
                    <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
                        @guest
                            @if (Route::has('login'))
                                <li>
                                    <a class="btn bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li>
                                    <a class="btn border border-green-500 hover:bg-green-500 text-green-500 hover:text-white py-2 px-4 rounded" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <!-- User Profile & Logout -->
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
