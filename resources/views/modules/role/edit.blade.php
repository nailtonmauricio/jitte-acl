@extends('templates.admin.index')
@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-1">
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item active"><a href="#" class="text-decoration-none">Nivel de acesso</a></li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span class="ms-auto">
                    <a href="{{ route('role.index') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-list"></i></a>
                </span>
            </div>
            <div class="card-body">
                <x-alert/>
                <form class="form-floating" name="edit-role" method="post" action="{{ route('role.update', ['role'=>$role->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="form-floating mb-3">
                        <input type="text" id="name" class="form-control" name="name" placeholder="Nome do nível de acesso" value="{{ old('name', $role->name) }}" autofocus required>
                        <label for="full_name">Nome</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="guard_name" name="guard_name" placeholder="Classe" value="{{ old('guard_name', $role->guard_name) }}">
                        <label for="nickname">Classe</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="order_roles" name="order_roles"
                               placeholder="Ordem" value="{{ old('order_roles', $role->order_roles) }}">
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
