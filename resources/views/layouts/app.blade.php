<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO -->
    <meta name="title" content="@yield('meta_title')">
    <meta name="description" content="@yield('meta_description')">

    <title>{{ config('app.name', 'rooland') }} - @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')

    <!-- Scripts -->
    @yield('js_head')

    <script>
        window.user = {
            authenticated: {{ auth()->check() ? 'true' : 'false' }}
        }
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'rooland') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('app.toggle_navigation')">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="dropdown-item {{ Route::currentRouteNamed('articles.home') ? 'active' : '' }}" href="/">
                                @lang('articles.menu_item_home')
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link{{ Route::currentRouteNamed('login') ? ' active' : '' }}" href="{{ route('login') }}">
                                    @lang('app.login')
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link{{ Route::currentRouteNamed('register') ? ' active' : '' }}" href="{{ route('register') }}">
                                        @lang('app.register')
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    @if (Auth::user()->isAdmin())
                                        <a class="dropdown-item{{ Route::currentRouteNamed('articles.index') ? ' active' : '' }}" href="{{ route('articles.index') }}">
                                            @lang('articles.menu_item_index')
                                        </a>
                                        <a class="dropdown-item{{ Route::currentRouteNamed('categories.index') ? ' active' : '' }}" href="{{ route('categories.index') }}">
                                            @lang('categories.menu_item_index')
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        @lang('app.logout')
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
        </nav>

        <main class="py-4 container">
            @yield('content')
            <div class="text-center py-3">
                © 2020 {{ config('app.name', 'rooland') }}. @lang('app.all_rights_reserved').<br>
                @lang('app.copyright_text')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('js_body')
</body>
</html>
