<div class="card mb-4 border-light shadow">
    <div class="card-header d-flex align-items-center gap-2">
        <input
                wire:model.live.debounce.500ms="search"
                id="search"
                name="search"
                class="form-control flex-grow-1"
                type="search"
                placeholder="Buscar por..."
                aria-label="Buscar usuários">

        @can('user-create')
            <a href="{{ route('user.create') }}"
               class="bg-gradient btn btn-primary text-nowrap"
               data-bs-toggle="tooltip" data-bs-placement="top"
               data-bs-original-title="Novo usuário" aria-label="Novo usuário">
                <i class="fa-solid fa-plus"></i>
            </a>
        @endcan
    </div>

    <div class="card-body">
        <x-alert/>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-2">
                <thead>
                <tr>
                    <th>NOME</th>
                    <th class="d-none d-sm-table-cell">E-MAIL</th>
                    <th class="d-none d-md-table-cell">CRIADO</th>
                    <th class="d-none d-lg-table-cell">MODIFICADO</th>
                    <th class="text-center" style="width: 1%">OPÇÕES</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($users as $user)
                    <tr wire:key="user-{{ $user->id }}">
                        <td>{{ $user->name }}</td>
                        {{-- E-mail longo: corta com reticências e mostra o completo ao passar o mouse --}}
                        <td class="d-none d-sm-table-cell">
                                <span class="d-inline-block text-truncate align-middle"
                                      style="max-width: 16rem" title="{{ $user->email }}">
                                    {{ $user->email }}
                                </span>
                        </td>
                        <td class="d-none d-md-table-cell text-nowrap">
                            {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i') }}
                        </td>
                        <td class="d-none d-lg-table-cell text-nowrap">
                            {{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i') }}
                        </td>

                        <td class="text-center text-nowrap">
                            <div class="d-inline-flex gap-1">
                                @can('user-show')
                                    <a href="{{ route('user.show', ['user' => $user->id]) }}"
                                       class="bg-gradient btn btn-sm btn-primary"
                                       data-bs-toggle="tooltip" data-bs-placement="top"
                                       data-bs-original-title="Visualizar" aria-label="Visualizar">
                                        <i class="fa-solid fa-folder-open"></i>
                                    </a>
                                @endcan

                                @can('user-edit')
                                    <a href="{{ route('user.edit', ['user' => $user->id]) }}"
                                       class="bg-gradient btn btn-sm btn-primary"
                                       data-bs-toggle="tooltip" data-bs-placement="top"
                                       data-bs-original-title="Editar" aria-label="Editar">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                @endcan

                                @can('user-destroy')
                                    <button type="button" wire:click="confirmDelete({{ $user->id }})"
                                            class="bg-gradient btn btn-sm btn-primary"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-original-title="Remover" aria-label="Remover">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center text-muted py-4" colspan="5">Nenhum resultado encontrado</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{ $users->links() }}
    </div>
</div>

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
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                },
            });

            setTimeout(() => { toastShown = false; }, 3500);
        });

        // Confirmação de exclusão (disparada pelo confirmDelete do componente)
        window.addEventListener('show-delete-confirmation', event => {
            const userId = event.detail.id;

            Swal.fire({
                title: 'Você tem certeza?',
                text: 'Essa ação não poderá ser desfeita!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    alert('Oops! Esta feature ainda não está pronta!');
                }
            });
        });
    </script>
@endpush