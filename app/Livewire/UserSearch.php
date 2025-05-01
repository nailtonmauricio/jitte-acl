<?php

namespace App\Livewire;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class UserSearch extends Component
{
    use WithPagination;

    public $search = '';
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['destroy'];


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($userId)
    {
        // Verifique se o método está sendo chamado
        Log::info('Solicitação de exclusão chamada para o ID do usuário:', ['userId' => $userId]);

        // Dispara o evento com o ID do usuário
        $this->dispatch('show-delete-confirmation', id: $userId);
    }

    public function destroy(User $user)
    {
        try {
            // Excluir o registro do banco de dados
            $user->delete();

            // Remover todas as permissões de usuários
            $user->syncRoles([]);

            // Salvar log
            Log::info('Usuário excluído.', ['id' => $user->id, 'user_action' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.index')->with('success', 'Usuário excluído com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::info('Usuário não excluído.', ['error' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('user.index')->with('error', 'Usuário não excluído!');
        }
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
