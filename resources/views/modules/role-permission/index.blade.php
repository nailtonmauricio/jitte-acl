@extends('templates.admin.index')
@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-1">
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none  ">Permissões</a></li>
                <li class="breadcrumb-item text-capitalize"><a href="#"
                                                               class="text-decoration-none  ">{{ $role->name }}</a></li>
                <li class="breadcrumb-item active">Listar</li>
            </ol>
        </div>

        @livewire('role-permission-search', ['roleId' => $role->id])

        {{--TRECHO PARA SER USADO SEM O LIVEWIRE--}}
        {{--<div class="card mb-4 border-light shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="flex-grow-1 d-flex justify-content-center">
                    <form class="d-flex" method="GET" action="{{ route('role-permission.search', ['role' => $role->id]) }}">
                        <div class="input-group">
                            <input id="searchTerm" name="searchTerm" class="form-control" type="text" placeholder="Buscar por..." aria-label="Search for..." aria-describedby="btnNavbarSearch">
                            <button class="btn btn-primary bg-gradient" type="submit" id="button-addon1"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
                <span class="ms-auto">
                    <a href="{{ route('role.index') }}" class="bg-gradient btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Listar" aria-label="Listar">
                        <i class="fa-solid fa-list"></i>
                    </a>
                </span>
            </div>
            <div class="card-body">
                <x-alert/>
                <table id="customers" class="display table table-stripped table-hover mb-2">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th class="d-none d-md-table-cell">NOME</th>
                        <th>DESCRIÇÃO</th>
                        <th>STATUS</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td class="d-none d-md-table-cell">{{ $permission->name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>
                                @if(in_array($permission->id, $rolePermissions ?? []))
                                    @can('role-index')
                                        <form id="permissionForm-{{ $permission->id }}" method="post" action="{{ route('role-permission.update', ['role'=>$role->id, 'permission'=> $permission->id]) }}">
                                            @method('POST')
                                            @csrf
                                            <input type="hidden" name="role" value="{{ $role->id }}">
                                            <input type="hidden" name="permission" value="{{ $permission->name }}">
                                            <input type="hidden" name="statusPermission" value="0">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="statusPermission" name="statusPermission" onchange="document.getElementById('permissionForm-{{ $permission->id }}').submit()" value="1" checked data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Clique para, bloquear!" aria-label="Bloquear">
                                                <label class="sr-only" for="statusPermission">Status da
                                                    permissão</label>
                                            </div>
                                        </form>
                                    @endcan
                                @else
                                    @can('role-index')
                                        <form id="permissionForm-{{ $permission->id }}" method="post" action="{{ route('role-permission.update', ['role'=>$role->id, 'permission'=>$permission->id]) }}">
                                            @method('POST')
                                            @csrf
                                            <input type="hidden" name="role" value="{{ $role->id }}">
                                            <input type="hidden" name="permission" value="{{ $permission->name }}">
                                            <input type="hidden" name="statusPermission" value="0">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="statusPermission" name="statusPermission" onchange="document.getElementById('permissionForm-{{ $permission->id }}').submit()" value="1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Clique para, liberar!" aria-label="Liberar">
                                                <label class="sr-only" for="statusPermission">Status da
                                                    permissão</label>
                                            </div>
                                        </form>
                                    @endcan
                                @endif
                            </td>
                        </tr>
                    @empty
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                Swal.fire({
                                    title: "Info!",
                                    text: "Nenhuma permissão encontrada...",
                                    icon: "info",
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            });
                        </script>
                    @endforelse
                    </tbody>
                </table>
                {{ $permissions->links() }}
            </div>
        </div>--}}
    </div>
@endsection
