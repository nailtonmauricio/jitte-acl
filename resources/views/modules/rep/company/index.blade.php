@extends('templates.admin.index')
@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-1">
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item active"><a href="#" class="text-decoration-none">Empresa</a></li>
                <li class="breadcrumb-item active">Listar</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-body">
                <x-alert/>
                <table id="users" class="display table table-stripped table-hover mb-2">
                    <thead>
                    <tr>
                        <th>NOME EMPRESARIAL</th>
                        <th>CNPJ</th>
                        <th class="d-none d-md-table-cell">SITE</th>
                        <th class="d-none d-md-table-cell">TELEFONE</th>
                        <th class="text-center">OPÇÕES</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($company as $info)
                        <tr>
                            <td>{{ $info->business_name }}</td>
                            <td>{{ $info->national_register_of_legal_entities }}</td>
                            <td class="d-none d-md-table-cell">{{ $info->site }}</td>
                            <td class="d-none d-md-table-cell">{{ $info->contact }}</td>
                            @can('company-show')
                                <td class="d-md-flex justify-content-center">
                                    @can('company-show')
                                        <a href="{{ route('company.show', ['company'=> $info->id]) }}"
                                           class="bg-gradient btn btn-xs btn-primary me-2 mt-1 mt-md-0"><i
                                                class="fa-solid fa-folder-open"></i></a>
                                    @endcan
                                    @can('company-edit')
                                        <a href="{{ route('company.edit', ['company'=>$info->id]) }}"
                                           class="bg-gradient btn btn-xs btn-dark me-2 mt-1 mt-md-0"><i
                                                class="fas fa-user-edit"></i></a>
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
                {{--{{ $users->links() }}--}}
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
