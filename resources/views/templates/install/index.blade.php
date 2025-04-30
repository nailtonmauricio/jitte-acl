<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>{{ env('APP_NAME') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])
    <link rel="icon" type="image/png" href="{{ env('APP_ICON') }}"/>
    <style>
        html, body {
            height: 100%;
        }
    </style>
</head>
<body class="h-100">
<div class="container-fluid h-100">
    <x-alert/>
    @yield('content')
</div>
@stack('scripts')
</body>
</html>
