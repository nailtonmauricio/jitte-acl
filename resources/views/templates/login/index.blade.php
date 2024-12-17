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
    <div class="row h-100">
        <!-- Área de fundo oculta em dispositivos menores -->
        <div class="col-md-9 d-none d-md-block" style="background-image: url('{{--{{ asset('images/bg-01.jpg') }}--}}'); background-size: cover; background-position: center;"></div>

        <!-- Área de formulário ajustável -->
        <div class="col-12 col-md-3 p-5 mt-5">
            <div class="row">
                <x-alert/>
                @yield('content')
                <div class="row text-center">
                    <div class="col-12">
                        <p>conheça nossas redes</p>
                    </div>
                    <div class="col-12 d-flex justify-content-center gap-3">
                        <a href="https://jitte.com.br" target="_blank"><i class="fa-solid fa-globe"></i></a>
                        <a href="https://github.com/nailtonmauricio" target="_blank"><i class="fa-brands fa-github"></i></a>
                        <a href="https://www.linkedin.com/in/nailtonmauricio" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stack('scripts')
</body>
</html>
