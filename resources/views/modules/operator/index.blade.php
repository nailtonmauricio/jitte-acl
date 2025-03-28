@extends('templates.admin.index')
@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-1">
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item active"><a href="#" class="text-decoration-none">Operadores</a></li>
                <li class="breadcrumb-item active">Listar</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span class="ms-auto">
                    @can('user-create')
                        <a href="{{ route('user.create') }}" class="bg-gradient btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Novo" aria-label="Novo"><i class="fa-solid fa-plus"></i></a>
                    @endcan
                </span>
            </div>
            <div class="card-body">
                <x-alert/>
                <table id="users" class="display table table-stripped table-hover mb-2">
                    <thead>
                    <tr>
                        <th>NOME</th>
                        <th>E-MAIL</th>
                        <th class="d-none d-md-table-cell">CRIADO</th>
                        <th class="d-none d-md-table-cell">MODIFICADO</th>
                        <th class="text-center">OPÇÕES</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="align-middle">{{ $user->name }}</td>
                            <td class="align-middle">{{ $user->email }}</td>
                            <td class="d-none d-md-table-cell align-middle">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s') }}</td>
                            <td class="d-none d-md-table-cell align-middle">{{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i:s') }}</td>
                            @can('user-show')
                            <td class="d-md-flex justify-content-center">
                                @can('user-show')
                                <a href="{{ route('user.show', ['user'=> $user->id]) }}"
                                   class="bg-gradient btn btn-sm btn-primary me-2 mt-1 mt-md-0" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Visualizar" aria-label="Visualizar"><i
                                        class="fa-solid fa-folder-open"></i></a>
                                @endcan
                                @can('user-edit')
                                <a href="{{ route('user.edit', ['user'=>$user->id]) }}"
                                   class="bg-gradient btn btn-sm btn-primary me-2 mt-1 mt-md-0" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Editar" aria-label="Editar"><i
                                        class="fas fa-user-edit"></i></a>
                                @endcan
                                @can('user-destroy')
                                <form action="{{ route('user.destroy', ['user'=>$user->id]) }}"
                                      method="post" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-gradient btn btn-sm btn-primary me-2 mt-1 mt-md-0" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Remover" aria-label="Remover"><i
                                            class="fas fa-user-minus"></i></button>
                                </form>
                                @endcan
                            </td>
                            @else
                                <td class="text-center"><span class="badge bg-danger">Negado</span></td>
                            @endcan
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
                {{ $users->links() }}
            </div>
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
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
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
@endsection
