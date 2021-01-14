<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('imgs/logo-sm.png') }}">

    <title>SOFTMAKING</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>

<body>
    <div id="app"></div>
</body>
<script src="{{ mix('js/app.js') }}"></script>

</html>
