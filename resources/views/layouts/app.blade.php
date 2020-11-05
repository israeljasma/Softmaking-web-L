<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('imgs/logo-sm.png') }}">

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
    <div id="app" class="bg-gray-100 h-screen">
        <!--
            Navbar custom SoftMaking
        -->
        <nav class="bg-gray-800">
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                <div class="relative flex items-center justify-between h-16">
                    <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                        <!-- Mobile menu button-->
                        <button id="navbar-toggler" onclick="toggleMenu()"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out"
                            aria-label="{{ __('Toggle navigation') }}" aria-expanded="false">

                            <!-- Icon when menu is closed. -->
                            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>

                            <!-- Icon when menu is open. -->
                            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                        <a class="flex items-center" href="{{ url('/home') }}">
                            <img class="block h-8 w-auto" src="{{ asset('imgs/logo-sm.png') }}" alt="Logo de Softmaking">
                            <span
                                class="hidden lg:block h-8 w-auto ml-2 text-xl text-white uppercase font-bold align-middle">{{ config('app.name', 'Laravel') }}</span>
                        </a>
                        <div id="mobile-menu" class="hidden sm:block ml-auto">
                            <!-- Authentication Links -->
                            <div class="flex">
                                @guest
                                    <a class="ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                    @if (Route::has('register'))
                                        <a class="ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                                            href="{{ route('register') }}">{{ __('Register') }}</a>
                                    @endif
                                @else
                                    <!-- Profile dropdown -->
                                    <div class="ml-3 relative">
                                        <div>
                                            <button
                                                class="flex items-center text-sm text-white font-light border-2 border-transparent rounded-full focus:outline-none focus:border-white transition duration-150 ease-in-out"
                                                id="user-menu" aria-label="User menu" aria-haspopup="true">
                                                <span class="mr-2">{{ Auth::user()->name }}</span>
                                                <svg class="h-8 w-8 rounded-full" aria-hidden="true" focusable="false"
                                                    data-prefix="fas" data-icon="user-circle"
                                                    class="svg-inline--fa fa-user-circle fa-w-16" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                                                    <path fill="currentColor"
                                                        d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg">
                                            <div class="py-1 rounded-md bg-white shadow-xs" role="menu"
                                                aria-orientation="vertical" aria-labelledby="user-menu">
                                                @can('manage-users')
                                                    <a href="{{ route('admin.users.index') }}"
                                                        class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                                        role="menuitem">(Gestión de usuarios) User Management</a>
                                                @endcan
                                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();"
                                                    class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                                    role="menuitem">{{ __('Logout') }}</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endguest
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!--
                Mobile menu, toggle classes based on menu state.   
                Menu open: "block", Menu closed: "hidden"
            -->
            <div id="nav-content" class="hidden sm:hidden">
                <div class="px-2 pt-2 pb-3">
                    @guest
                        <a class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                            href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                                href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        @can('manage-users')
                            <a href="{{ route('admin.users.index') }}"
                                class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                                role="menuitem">(Gestión de usuarios) User Management</a>
                        @endcan
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                            class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                            role="menuitem">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </nav>


        <main class="flex items-center justify-center mx-2">
            <div class="container">
                @include('partials.alerts')
                @yield('content')
            </div>
        </main>
    </div>

    <style>
        html,
        body {
            height: 100%;
        }

        .active {
            display: block;
        }
      
        @media (min-width: 640px) {
          table {
            display: inline-table !important;
          }
      
          thead tr:not(:first-child) {
            display: none;
          }
        }
      
        td:not(:last-child) {
          border-bottom: 0;
        }
      
        th:not(:last-child) {
          border-bottom: 2px solid rgba(0, 0, 0, .1);
        }
    </style>

    <script>
        function toggleMenu() {
            document.getElementById("nav-content").classList.toggle("hidden");
        }
    </script>
</body>

</html>
