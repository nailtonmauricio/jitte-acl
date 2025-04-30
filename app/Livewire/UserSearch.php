<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UserSearch extends Component
{
    use WithPagination;

    public $search = '';
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $authenticatedUser = Auth::user();
        $authenticatedUserLevel = $authenticatedUser->roles[0]->order_roles;

        $users = User::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        })
            ->whereHas('roles', function ($query) use ($authenticatedUserLevel) {
                $query->where('order_roles', '>=', $authenticatedUserLevel);
            })
            ->where('id', '!=', $authenticatedUser->id)
            ->where('name', '!=', 'Root')
            ->paginate(8);

        if (!empty($this->search) && $users->isEmpty()) {
            $this->dispatch('no-results-found');
        }

        return view('livewire.user-search', ['users' => $users]);
    }
}
