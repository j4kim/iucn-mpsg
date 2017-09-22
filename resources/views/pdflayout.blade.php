<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pdf.css') }}">

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" />

</head>
<body>
    <div class="not-printed explanations">
        <div class="container-fluid">
            <p>To generate a PDF file, simply <a href="javascript:window.print()">Open the print dialog</a> and select "Print to PDF" or equivalent.<br>
            @yield('back')
        </div>
    </div>
    <div class="container-fluid">
        @yield('content')
    </div>
</body>
</html>