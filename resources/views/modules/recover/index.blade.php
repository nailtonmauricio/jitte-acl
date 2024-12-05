@extends('templates.login.index')
@section('content')
    <form class="login100-form validate-form" action="{{ route('recover.process') }}" method="POST">
        @csrf
        @method('POST')

        <span class="login100-form-title p-b-43">
						Recuperar senha
					</span>

        <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            <label for="user"></label><input id="email" class="input100" type="text" name="email" value="{{ old('email') }}">
            <span class="focus-input100"></span>
            <span class="label-input100">E-Mail</span>
        </div>

        <div class="flex-sb-m w-full p-t-3 p-b-32">
            <div>
                <a href="{{ route('login.index') }}" class="txt1">
                    Retornar ao login
                </a>
            </div>
        </div>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn" onclick="this.innerText = 'Enviando...'">
                Enviar
            </button>
        </div>

        <div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							conheça nossas redes
						</span>
        </div>

        <div class="login100-form-social flex-c-m">
            <a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5 text-decoration-none">
                <i class="fa-brands fa-facebook-f" aria-hidden="true"></i>
            </a>

            <a href="{{ env('SOCIAL_INSTAGRAM') }}" class="login100-form-social-item flex-c-m bg3 m-r-5 text-decoration-none" target="_blank">
                <i class="fa-brands fa-instagram" aria-hidden="true"></i>
            </a>
        </div>
    </form>

    <div class="login100-more" style="background-image: url({{--{{ asset('images/bg-01.jpg') }}--}});">
    </div>
@endsection

