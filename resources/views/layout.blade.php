<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/js/app.js')
    @vite('resources/sass/app.scss')
</head>
<body>
    <div id="app">
        @yield('content')
    </div>
</body>
</html>
