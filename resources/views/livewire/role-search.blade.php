<div class="card mb-4 border-light shadow">
    <div class="card-header d-flex align-items-center gap-2">
        <input
                wire:model.live.debounce.500ms="search"
                id="search"
                name="search"
                class="form-control flex-grow-1"
                type="search"
                placeholder="Buscar por..."
                aria-label="Buscar papéis">

        @can('role-create')
            <a href="{{ route('role.create') }}"
               class="bg-gradient btn btn-primary text-nowrap"
               data-bs-toggle="tooltip" data-bs-placement="top"
               data-bs-original-title="Novo papel" aria-label="Novo papel">
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
                    <th class="d-none d-sm-table-cell">TIPO</th>
                    <th class="d-none d-md-table-cell">CRIADO</th>
                    <th class="d-none d-lg-table-cell">MODIFICADO</th>
                    <th class="text-center" style="width: 1%">OPÇÕES</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($roles as $role)
                    <tr wire:key="role-{{ $role->id }}">
                        <td class="text-capitalize">{{ $role->name }}</td>
                        <td class="d-none d-sm-table-cell text-capitalize">{{ $role->guard_name }}</td>
                        <td class="d-none d-md-table-cell text-nowrap">
                            {{ \Carbon\Carbon::parse($role->created_at)->format('d/m/Y H:i') }}
                        </td>
                        <td class="d-none d-lg-table-cell text-nowrap">
                            {{ \Carbon\Carbon::parse($role->updated_at)->format('d/m/Y H:i') }}
                        </td>

                        <td class="text-center text-nowrap">
                            <div class="d-inline-flex gap-1">
                                <a href="{{ route('role-permission.index', ['role' => $role->id]) }}"
                                   class="bg-gradient btn btn-sm btn-primary"
                                   data-bs-toggle="tooltip" data-bs-placement="top"
                                   data-bs-original-title="Permissões" aria-label="Permissões">
                                    <i class="fa-solid fa-list-check"></i>
                                </a>

                                <a href="{{ route('role.edit', ['role' => $role->id]) }}"
                                   class="bg-gradient btn btn-sm btn-primary"
                                   data-bs-toggle="tooltip" data-bs-placement="top"
                                   data-bs-original-title="Editar" aria-label="Editar">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
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

        {{ $roles->links() }}
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
    </script>
@endpush