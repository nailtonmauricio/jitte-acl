<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleSearch extends Component
{
    use WithPagination;

    public string $search = '';

    protected array $updatesQueryString = ['search'];
    protected string $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $loggedUser = auth()->user();
        $loggedUserRole = $loggedUser->roles()->first();

        $roles = Role::where('name', 'like', '%'.$this->search.'%')
            ->where('name', '!=', 'root')
            ->where('id', '!=', $loggedUserRole->id)
            ->where('order_roles', '>', $loggedUserRole->order_roles)
            ->paginate(8);

        return view('livewire.role-search', [
            'menu' => 'niveis-acesso',
            'roles' => $roles]);
    }
}
