@extends('templates.login.index')
@section('content')
    <form class="login100-form validate-form" action="{{route('change-password')}}" method="POST">
        @csrf
        @method('POST')
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <span class="login100-form-title p-b-43">
						Alterar senha
					</span>

        <div class="wrap-input100 validate-input" data-validate="A senha deve ter no mínimo seis caracteres">
            <label for="password"></label><input id="password" class="input100" type="password" name="password">
            <span class="focus-input100"></span>
            <span class="label-input100">Nova senha</span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="A confirmação de senha deve ser igual">
            <label for="password_confirmation"></label><input id="password_confirmation" class="input100"
                                                              type="password" name="password_confirmation">
            <span class="focus-input100"></span>
            <span class="label-input100">Confirmar senha</span>
        </div>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn" onclick="this.innerText = 'Processando...'">
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

            <a href="{{ env('SOCIAL_INSTAGRAM') }}" class="login100-form-social-item flex-c-m bg3 m-r-5 text-decoration-none"
               target="_blank">
                <i class="fa-brands fa-instagram" aria-hidden="true"></i>
            </a>
        </div>
    </form>

    <div class="login100-more" style="background-image: url({{ asset('images/bg-01.jpg') }});">
    </div>
@endsection
