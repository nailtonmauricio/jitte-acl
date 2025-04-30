<div class="card mb-4 border-light shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="flex-grow-1 d-flex justify-content-center">
            <form wire:submit.prevent="search" class="d-flex" method="POST">
                @csrf
                <input wire:model.live.debounce.500ms="search" id="search" name="search" class="form-control" type="text" placeholder="Buscar por..." aria-label="Search for..." aria-describedby="btnNavbarSearch">
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
                <tr>
                    <td class="text-center" colspan="5">Nenhum resultado encontrado</td>
                </tr>
            @endforelse
            </tbody>
        </table>

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
        </script>

        {{ $permissions->links() }}
    </div>
</div>
