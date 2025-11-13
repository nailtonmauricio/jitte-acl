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


        body {
            background: url('{{ asset('images/bg-tech.png') }}') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Inter', sans-serif;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 150px;
            backdrop-filter: blur(4px);
        }

        .login-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            padding: 40px;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
        }

        .login-card h3 {
            font-weight: 600;
            color: #222;
        }

        @media (max-width: 768px) {
            .login-container {
                justify-content: center;
                padding: 20px !important;
            }

            .login-card {
                max-width: 100%;
                padding: 25px !important;
            }

            body {
                background-attachment: scroll !important;
                background-position: center !important;
            }
        }
    </style>
</head>
<body>
<div class="login-container">
    <div class="login-card">
        <x-alert/>
        @yield('content')

        <div class="col-12">
            <p>conheça nossas redes</p>
        </div>
        <div class="col-12 d-flex justify-content-center gap-3">
            <a href="{{ env('WEB_SITE') }}" target="_blank"><i class="fa-solid fa-globe"></i></a>
            <a href="{{ env('GITHUB') }}" target="_blank"><i class="fa-brands fa-github"></i></a>
            <a href="{{ env('LINKEDIN') }}" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
        </div>
    </div>
</div>
@stack('scripts')
</body>
</html>
