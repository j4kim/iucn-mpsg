<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Bootstrap Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Bootstrap Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pdf.css') }}">

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,500,500i" rel="stylesheet">

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