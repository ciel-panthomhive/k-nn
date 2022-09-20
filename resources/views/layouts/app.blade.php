<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-red shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img id="logo-main" src="{{ asset('assets/images/logo2.png') }}" width="100"
                        alt="Logo Thing main logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    {{-- <ul class="navbar-nav me-auto"> --}}

                    {{-- <li> --}}
                    <h3>BIRAWA CELL</h3>
                    {{-- </li> --}}

                    {{-- </ul> --}}

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('profil', ['id' => Auth::user()->id]) }}">{{ Auth::user()->name }}</a>
                            </li>
                            {{-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                    {{ Auth::user()->name }}
                                </a> --}}

                            {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.edit', ['id' => Auth::user()->id]) }}">
                                        {{ __('Profil') }}
                                    </a>

                                    <form id="profil-form" action="{{ route('user.edit', ['id' => Auth::user()->id]) }}"
                                        method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="{{ route('change', ['id' => Auth::user()->id]) }}">
                                        {{ __('Ubah Password') }}
                                    </a>

                                    <form id="profil-form" action="{{ route('change', ['id' => Auth::user()->id]) }}"
                                        method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a> --}}

                            {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> --}}
                            @csrf
                            </form>
                    </div>
                    </li>
                @endguest
                </ul>
            </div>
    </div>
    </nav>

</html>
