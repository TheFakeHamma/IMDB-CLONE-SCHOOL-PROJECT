<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body r" data-bs-theme="dark">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('index') }}">
            <img src="{{ asset('images/logo-small.png') }}" alt="Logo" width="100%">
        </a>

        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Search bar and navigation -->
            <div class="d-flex w-100">
                <!-- Search form -->
                <form class="flex-fill me-3" role="search" action="{{ route('search') }}" method="GET">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search"
                            name="search" value="{{ request('search') }}">
                        <select class="form-select" name="searchType" style="width: 20% !important;">
                            <option value="content"{{ request('searchType') == 'content' ? ' selected' : '' }}>Content
                            </option>
                            <option value="people"{{ request('searchType') == 'people' ? ' selected' : '' }}>People
                            </option>
                        </select>
                        <button class="btn btn-outline-success ms-2" type="submit">Search</button>
                    </div>
                </form>
                <!-- Navigation links -->
                <ul class="navbar-nav flex-fill justify-content-end me-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('people') }}">People</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Movies & Shows
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('contents') }}?type=movie">Movies</a></li>
                            <li><a class="dropdown-item" href="{{ route('contents') }}?type=tv_show">TV Shows</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('contents') }}">Show all</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Genres
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($genres as $genre)
                                <li class="nav-item">
                                    <a class="dropdown-item"
                                        href="{{ route('contents') }}?genre[]={{ $genre->name }}">{{ $genre->name }}</a>
                                </li>
                            @endforeach
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">All Genres</a></li>
                        </ul>
                    </li>
                    {{-- User admin panel --}}
                    @can('manage-users')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Admin Panel
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                                <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">User Settings</a></li>
                                <li><a class="dropdown-item" href="#">Content</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.people.index') }}">Manage People</a></li>
                            </ul>
                        </li>
                    @endcan
                </ul>
                <ul class="navbar-nav">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item me-2">
                                <a class="btn btn-success" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="btn btn-outline-success ms-2"
                                    href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-success" href="{{ route('user.profile', Auth::user()->username) }}">
                                {{ __('Profile') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>

                    @endguest
                </ul>
                </ul>
            </div>
        </div>
</nav>
