<html>
<head>
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link href="https://cdn.quilljs.com/1.2.0/quill.snow.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>