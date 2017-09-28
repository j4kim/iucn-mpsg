<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }} - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Bootstrap Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Bootstrap Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    @yield('head')

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,500,500i" rel="stylesheet">

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
    @yield('header')
    <div class="container content">
        @yield('content')
    </div>
    <footer>
        Web design and development © <a href="j4kim.ch">j4kim.ch</a> – 2017
    </footer>
    @yield('scripts')
</body>
</html>