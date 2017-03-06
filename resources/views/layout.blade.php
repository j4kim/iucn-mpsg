<html>
<head>
    <title>{{ config('app.name') }} - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Quill -->
    <link href="https://cdn.quilljs.com/1.2.0/quill.snow.css" rel="stylesheet">

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}
    <!-- Latest compiled and minified JavaScript -->
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>--}}

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


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
                        <a href="/"
                        {{ is_numeric(strpos(Request::path(), strtolower($tab))) ? 'class="active"':'' }}
                        >
                            {{ $tab }}
                        </a>
                    </li>
                @endforeach
            </ul>
            {{--<nav class="navbar navbar-default">--}}
                {{--<div class="container">--}}
                    {{--<div class="navbar-header">--}}
                        {{--<a href="{{ url('/') }}" class="title-logo">--}}
                            {{--<img src="{{ asset('images/logo-iucn.png') }}">--}}
                            {{--<h1>{{ config('app.name') }}</h1>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                    {{--<ul class="nav navbar-nav">--}}
                        {{--@foreach(["About", "Species", "Islands", "Downloads", "Links", "Contact",] as $tab)--}}
                            {{--<li><a href="#">{{ $tab }}</a></li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                    {{--<h1 class="title">@yield('title')</h1>--}}
                {{--</div>--}}
            {{--</nav>--}}
        </div>
    </header>
    <div class="img-header">
        @yield('header')
    </div>
    <div class="container content">
        @yield('content')
    </div>
    @yield('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>