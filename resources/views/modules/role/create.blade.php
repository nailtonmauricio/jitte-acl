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
                    <a href="{{ route('role.index') }}" class="bg-gradient btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Listar" aria-label="Listar"><i
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
                        <select name="guard_name" class="form-select" id="guard_name">
                            <option value="">Selecione</option>
                            <option value="web" {{ old('guard_name') == 'web' ? 'selected' : '' }}>Web</option>
                            <option value="api" {{ old('guard_name') == 'api' ? 'selected' : '' }}>API</option>
                        </select>
                        <label for="guard_name">Tipo de controle</label>
                    </div>

                    <div class="form-floating mb-3">
                        @php
                            $nextRoleId = $roles->max('id') + 1;
                        @endphp

                        <select name="order_roles" id="order_roles" class="form-select">
                            <option value="{{ $nextRoleId }}">Selecione</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->order_roles }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <label for="order_roles">Ordem</label>
                    </div>

                    <div class="d-flex justify-content-end mb-2">
                        <button type="submit" class="bg-gradient btn btn-primary">Gravar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
