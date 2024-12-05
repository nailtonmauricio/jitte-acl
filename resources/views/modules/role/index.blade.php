@extends('templates.admin.index')
@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-1">
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item active"><a href="#" class="text-decoration-none">Níveis de acesso</a></li>
                <li class="breadcrumb-item active">Listar</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span class="ms-auto">
                    @can('user-create')
                        <a href="{{ route('role.create') }}" class="bg-gradient btn btn-success btn-sm"><i
                                class="fa-solid fa-plus"></i></a>
                    @endcan
                </span>
            </div>
            <div class="card-body">
                <x-alert/>
                <table id="customers" class="display table table-stripped table-hover mb-2">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>CLASSE</th>
                        <th class="d-none d-md-table-cell">CRIADO</th>
                        <th class="d-none d-md-table-cell">MODIFICADO</th>
                        <th>OPÇÕES</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($roles as $role)

                        <tr>
                            <td class="text-capitalize">{{ $role->id }}</td>
                            <td class="text-capitalize">{{ $role->name }}</td>
                            <td class="text-capitalize">{{ $role->guard_name }}</td>
                            <td class="d-none d-md-table-cell">{{ \Carbon\Carbon::parse($role->created_at)->format('d/m/Y H:i:s') }}</td>
                            <td class="d-none d-md-table-cell">{{ \Carbon\Carbon::parse($role->updated_at)->format('d/m/Y H:i:s') }}</td>
                            <td>
                                <a href="{{ route('role-permission.index', ['role'=> $role->id]) }}"
                                   class="bg-gradient btn btn-xs btn-primary me-2 mt-1 mt-md-0"><i
                                        class="fa-solid fa-list-check"></i></a>
                                <a href="{{ route('role.edit', ['role'=>$role->id]) }}"
                                   class="bg-gradient btn btn-xs btn-dark me-2 mt-1 mt-md-0"><i
                                        class="fas fa-user-edit"></i></a>
                            </td>
                        </tr>
                    @empty
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                Swal.fire({
                                    title: "Info!",
                                    text: "Não foram encontrados registros na base de dados.",
                                    icon: "info",
                                    showConfirmButton: false,
                                    timer: 2000,
                                });
                            });
                        </script>
                    @endforelse
                    </tbody>
                </table>
                {{ $roles->links() }}
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const deleteForms = document.querySelectorAll('.delete-form');
                deleteForms.forEach(form => {
                    form.addEventListener('submit', function (e) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Você tem certeza?',
                            text: "Ação irreversível, deseja realmente prosseguir?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sim, deletar!',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
    </div>
@endsection
