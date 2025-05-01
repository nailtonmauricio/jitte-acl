<div class="card mb-4 border-light shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="flex-grow-1 d-flex justify-content-center">
            <form class="d-flex" wire:submit.prevent="search" method="POST">
                @csrf
                <input wire:model.live.debounce.500ms="search" id="search" name="search" class="form-control" type="text" placeholder="Buscar por..." aria-label="Search for..." aria-describedby="btnNavbarSearch">
            </form>
        </div>
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
                        <td class="text-center">
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
                                 <button wire:click="confirmDelete( {{ $user->id }})" class="bg-gradient btn btn-sm btn-primary me-2 mt-1 mt-md-0" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Remover" aria-label="Remover"><i
                                                class="fas fa-user-minus"></i></button>
                            @endcan
                        </td>
                    @else
                        <td class="text-center"><span class="badge bg-danger">Negado</span></td>
                    @endcan
                </tr>
            @empty
                <td class="text-center" colspan="5">Nenhum resultado encontrado</td>
            @endforelse
            </tbody>
        </table>
        @push('scripts')
        <script>
            let toastShown = false;

            window.addEventListener('no-results-found', () => {
                if (toastShown) return;
                toastShown = true;

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'info',
                    title: 'Nenhum resultado encontrado.',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                // Opcional: resetar o flag após o timer
                setTimeout(() => {
                    toastShown = false;
                }, 3500);
            });

            //Realiza a chamada ao sweetalert de exclusão
            window.addEventListener('show-delete-confirmation', event => {
                const userId = event.detail.id;

                Swal.fire({
                    title: 'Você tem certeza?',
                    text: "Essa ação não poderá ser desfeita!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sim, deletar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Emite o evento para Livewire
                        //Livewire.emit('destroy', id);
                        alert('Oops! Esta feature ainda não está pronta!')
                    }
                });
            });
        </script>
        @endpush
        {{ $users->links() }}
    </div>
</div>
