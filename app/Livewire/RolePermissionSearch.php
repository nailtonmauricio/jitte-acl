<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class RolePermissionSearch extends Component
{
    use WithPagination;

    public string $search = '';
    public Role $role;

    protected string $paginationTheme = 'bootstrap';
    protected array $updatesQueryString = ['search'];

    public function mount($roleId)
    {
        $this->role = Role::findOrFail($roleId);

        $loggedUser = Auth::user();
        $loggedUserRole = $loggedUser->roles()->pluck('role_id')->first();

        if ($this->role->name === 'root' || $loggedUserRole >= $this->role->id) {
            abort(403, 'Acesso negado');
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $rolePermissions = $this->role->permissions()->pluck('id')->toArray();

        $permissions = Permission::where('name', 'like', '%' . $this->search . '%')
            ->paginate(8);

        return view('livewire.role-permission-search', [
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
        ]);
    }
}
