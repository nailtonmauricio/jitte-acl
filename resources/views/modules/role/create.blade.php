@extends('templates.admin.index')
@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-1">
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item active"><a href="#" class="text-decoration-none">Nível de acesso</a></li>
                <li class="breadcrumb-item active">Cadastrar</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span class="ms-auto">
                    <a href="{{ route('role.index') }}" class="bg-gradient btn btn-primary btn-sm"><i
                            class="fa-solid fa-list"></i></a>
                </span>
            </div>
            <div class="card-body">
                <x-alert/>
                <form class="form-floating" name="create-customer" method="post"
                      action="{{ route('role.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="form-floating mb-3">
                        <input type="text" id="name" class="form-control" name="name"
                               placeholder="Nome da permissão" value="{{ old('name') }}" autofocus>
                        <label for="name">Nome</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="guard_name" name="guard_name"
                               placeholder="Tipo de rota" value="{{ old('guard_name') }}">
                        <label for="guard_name">Tipo de controle</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="order_roles" name="order_roles"
                               placeholder="Ordem" value="{{ old('order_roles') }}">
                        <label for="guard_name">Ordem</label>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        <button type="submit" class="bg-gradient btn btn-primary">Gravar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
