<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div id="topbar" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="pull-right">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span> </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
    <div id="sidebar">
        <div class="logo">
            <a href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>
        <ul class="nav">
            <li><font-awesome-icon icon="vials"></font-awesome-icon><a href="{{route('movies.index')}}">Movies</a></li>
{{--            <li><font-awesome-icon icon="vials"></font-awesome-icon><a href="{{route('shows.index')}}">Shows</a></li>--}}
{{--            <li><font-awesome-icon icon="vials"></font-awesome-icon><a href="{{route('books.index')}}">Books</a></li>--}}
{{--            <li><font-awesome-icon icon="vials"></font-awesome-icon><a href="{{route('seasons.index')}}">Seasons</a></li>--}}
{{--            <li><font-awesome-icon icon="vials"></font-awesome-icon><a href="{{route('episodes.index')}}">Episodes</a></li>--}}
            <li><font-awesome-icon icon="vials"></font-awesome-icon><a href="{{route('rating-partials.create')}}">Make Partial</a></li>
            <li><font-awesome-icon icon="vials"></font-awesome-icon><a href="{{route('profiles.create')}}">Make Profile</a></li>
{{--            <li><font-awesome-icon icon="vials"></font-awesome-icon><a href="#"></a></li>--}}
{{--            <li><font-awesome-icon icon="vials"></font-awesome-icon><a href="#"></a></li>--}}
{{--            <li><font-awesome-icon icon="vials"></font-awesome-icon><a href="#"></a></li>--}}
        </ul>
    </div>

    <main class="container">
        @yield('content')
    </main>
</div>
</body>
</html>
