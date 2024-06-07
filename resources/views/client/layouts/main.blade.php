<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vite App</title>
</head>
@yield('content')
<script type="module" src="{{ asset('assets/js/app.js') }}"></script>
{{--<script type="module" src="{{ asset('js/app.js') }}" defer></script>--}}
</html>
