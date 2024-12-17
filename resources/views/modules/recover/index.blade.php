@extends('templates.login.index')
@section('content')
    <div class="row mt-5">
        <h3 class="text-center">Recuperar Senha</h3>
    </div>
    <form class="login100-form validate-form" action="{{ route('recover.process') }}" method="POST">
        @csrf
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="e-mail">
            <label for="email">E-Mail</label>
        </div>
        <div class="row mt-3 mb-4">
            <div class="col-6">
                <a href="{{ route('login.index') }}" class="nav-link">
                    Retornar ao login
                </a>
            </div>
        </div>
        <div class="d-grid gap-2 mb-2">
            <button type="submit" class="btn btn-lg btn-dark bg-gradient">ENVIAR</button>
        </div>
    </form>
@endsection

