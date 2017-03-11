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


</head>
<body>
    <header>
        <div class="container">
            <a href="{{ url('/') }}" class="title-logo">
                <img src="{{ asset('images/logo-iucn.png') }}">
                <h1>{{ config('app.name') }}</h1>
            </a>
            <ul class="nav">
                @foreach(["About", "Species", "Islands", "Downloads", "Links", "Contact"] as $tab)
                    <li>
                        <a href="{{ url('/' . strtolower($tab)) }}"
                        {{ is_numeric(strpos(Request::path(), strtolower($tab))) ? 'class=active':'' }}
                        >
                            {{ $tab }}
                        </a>
                    </li>
                @endforeach
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