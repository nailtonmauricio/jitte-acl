@extends('templates.login.index')
@section('content')
    <div class="row mt-5">
        <h3 class="text-center">Área de Login</h3>
    </div>
    <form class="login100-form validate-form" action="{{ route('login.process') }}" method="POST">
        @csrf
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="e-mail">
            <label for="email">E-Mail de usuário</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
            <label for="password">Senha</label>
        </div>
        <div class="row mt-3 mb-4">
            <div class="col-8">
                <a href="{{ route('recover.index') }}" class="nav-link">
                    Esqueceu a senha?
                </a>
            </div>
        </div>
        <div class="d-grid gap-2 mb-2">
            <button type="submit" class="btn btn-lg btn-dark bg-gradient">ENTRAR</button>
        </div>
    </form>
@endsection
