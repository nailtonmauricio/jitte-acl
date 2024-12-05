@extends('templates.admin.index')
@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-1">
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item active"><a href="#" class="text-decoration-none">Operador</a></li>
                <li class="breadcrumb-item active">Perfil</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span class="ms-auto">
                    @can('user-edit')
                    <a href="{{ route('user.edit', ['user'=>$user->id]) }}" class="bg-gradient btn btn-sm btn-dark"><i
                            class="fas fa-user-edit"></i></a>
                    @endcan
                    <a href="{{ route('user.index') }}" class="bg-gradient btn btn-primary btn-sm"><i
                            class="fa-solid fa-list"></i></a>
                </span>
            </div>
            <div class="card-body">
                <x-alert/>

                <dl class="row">
                    <dt class="col-sm-3">Nome:</dt>
                    <dd class="col-sm-9">{{ $user->name }}</dd>

                    <dt class="col-sm-3">E-Mail:</dt>
                    <dd class="col-sm-9">{{ $user->email }}</dd>

                    <dt class="col-sm-3">Permissão:</dt>
                    <dd class="col-sm-9">
                        @forelse($user->getRoleNames() as $role)
                            {{ $role }}
                        @empty
                            {{ '-' }}
                        @endforelse
                    </dd>

                    <dt class="col-sm-3">Criado:</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s') }}</dd>

                    <dt class="col-sm-3">Modificado:</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i:s') }}</dd>
                </dl>
            </div>
        </div>
    </div>
@endsection

