<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }} - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Quill -->
    {{--<link href="https://cdn.quilljs.com/1.2.0/quill.snow.css" rel="stylesheet">--}}

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" />

</head>
<body>
    <header>
        <div class="container">
            <a class="title-logo" href="/">
                <img src="{{ asset('images/iucn_logo.png') }}">
                <h1>TOP 50 Mediterranean Island Plants UPDATE 2017</h1>
            </a>
            <ul class="nav">
                <li>
                    <a href="{{ url('/') }}"
                    {{ Request::path()=="/" ? 'class=active':'' }}
                    >
                        Home
                    </a>
                </li>
                @foreach(["About", "Species", "Islands", "Downloads", "Links", "Contact"] as $tab)
                    <li>
                        <a href="{{ url('/' . strtolower($tab)) }}"
                        {{ is_numeric(strpos(Request::path(), strtolower($tab))) ? 'class=active':'' }}
                        >
                            {{ $tab }}
                        </a>
                    </li>
                @endforeach
                @if(Auth::check())
                    <li>
                        <a class="logout" href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </header>
    <div class="img-header">
        @yield('header')
    </div>
    <div class="container content">
        @yield('content')
    </div>
    <footer>
        IUCN's Top 50 Mediterranean Island Plants - 2017 - Joaquim Perez
    </footer>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>