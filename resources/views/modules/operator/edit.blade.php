@extends('templates.admin.index')
@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-1">
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item active"><a href="#" class="text-decoration-none">Operador</a></li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span class="ms-auto">
                    <a href="{{ route('user.index') }}" class="bg-gradient btn btn-primary btn-sm"><i class="fa-solid fa-list"></i></a>
                </span>
            </div>
            <div class="card-body">
                <x-alert/>
                <form class="form-floating" name="create-customer" method="post" action="{{ route('user.update', ['user'=>$user->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="form-floating mb-3">
                        <input type="text" id="name" class="form-control" name="name" placeholder="Nome completo" value="{{ old('name', $user->name) }}" autofocus>
                        <label for="name">Nome</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail" value="{{ old('email', $user->email) }}">
                        <label for="email">E-Mail</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
                        <label for="email">Senha</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="roles" class="form-select" id="roles">
                            <option value="">Selecione</option>
                            @forelse($roles as $role)
                                @if($role != 'root')
                                    <option {{ old('roles', $userRole) == $role ? 'selected' : '' }} value="{{ $role }}">{{ $role }}</option>
                                @else
                                    @if(Auth::user()->hasRole('root'))
                                        <option {{ old('roles', $userRole) == $role ? 'selected' : '' }} value="{{ $role }}">{{ $role }}</option>
                                    @endif
                                @endif
                            @empty
                                <option value="">Não permitido</option>
                            @endforelse
                        </select>
                        <label for="roles">Nível de acesso</label>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        <button type="submit" class="bg-gradient btn btn-primary">Gravar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
