<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtém o usuário autenticado
        $authenticatedUser = auth()->user();

        // Obtém o nível do usuário autenticado
        $authenticatedUserLevel = $authenticatedUser->roles[0]->order_roles;

        // Obtém o ID do usuário logado
        $loggedUserId = $authenticatedUser->id;

        // Busca os usuários com nível igual ou menor que o do usuário logado
        $users = User::whereHas('roles', function ($query) use ($authenticatedUserLevel) {
            $query->where('order_roles', '>=', $authenticatedUserLevel);
        })
            ->where('name', '!=', 'Root')
            ->where('id', '!=', $loggedUserId)
            ->paginate(8);

        return view('modules.operator.index', ['menu' => 'operadores', 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy('name', 'asc')->pluck('name')->all();

        return view('modules.operator.create', ['menu' => 'operadores', 'roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // Validar o formulário
        $request->validated();

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Cadastrar no banco de dados na tabela usuários
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            // Cadastra o nivel de acesso na tabela papeis
            $user->assignRole($request->roles);

            // Salvar log
            Log::info('Usuário cadastrado.', ['id' => $user->id, $user]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.show', ['user' => $user->id])->with('success', 'Usuário cadastrado com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::info('Usuário não cadastrado.', ['error' => $e->getMessage()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Usuário não cadastrado!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $authenticatedUser = auth()->user();
        if ($authenticatedUser->roles[0]->order_roles > $user->roles[0]->order_roles) {

            Log::info('Você não tem permissão para acessar esse registro.', ['id' => $user->id, 'action_user_id' => Auth::id()]);

            return redirect()->route('user.index', ['user' => $user->id])->with('error', 'Sem permissão de visualizar usuário!');
        }

        return view('modules.operator.show', ['menu' => 'operadores', 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $authenticatedUser = auth()->user();

        // Verifica a permissão do usuário autenticado
        if ($authenticatedUser->roles[0]->order_roles >= $user->roles[0]->order_roles) {
            Log::info('Você não tem permissão para acessar esse registro.', [
                'id' => $user->id,
                'action_user_id' => Auth::id()
            ]);

            return redirect()->route('user.index', ['user' => $user->id])->with('error', 'Você não tem permissão para editar esse registro.');
        }

        // Recupera o nível de acesso do usuário autenticado
        $authenticatedUserOrderRole = $authenticatedUser->roles[0]->order_roles;

        // Recupera apenas os papéis com order_roles maior ou igual ao do usuário autenticado
        $roles = Role::where('order_roles', '>=', $authenticatedUserOrderRole)
            ->pluck('name')
            ->all();

        // Recupera o nível de acesso do usuário
        $userRole = $user->roles->pluck('name')->first();

        return view('modules.operator.edit', [
            'menu' => 'operadores',
            'user' => $user,
            'roles' => $roles,
            'userRole' => $userRole
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $updated = false;
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $changes = [];

            if ($user->name != $validated['name']) {
                $changes['name'] = $validated['name'];
                $updated = true;
            }

            if ($user->email != $validated['email']) {
                $changes['email'] = $validated['email'];
                $updated = true;
            }

            if (!empty($validated['password'])) {
                $changes['password'] = bcrypt($validated['password']);
                $updated = true;
            }

            // Garantindo que $validated['roles'] seja um array
            $newRoles = is_array($validated['roles']) ? $validated['roles'] : explode(',', $validated['roles']);

            // Pegando os papéis atuais do usuário
            $currentRoles = $user->roles->pluck('name')->toArray();

            // Verificando diferenças
            if (array_diff($currentRoles, $newRoles) || array_diff($newRoles, $currentRoles)) {
                $changes['roles'] = $newRoles;
                $updated = true;
            }

            if (!empty($changes)) {
                // Atualiza o modelo
                if (isset($changes['name'])) {
                    $user->name = $changes['name'];
                }

                if (isset($changes['email'])) {
                    $user->email = $changes['email'];
                }

                if (isset($changes['password'])) {
                    $user->password = $changes['password'];
                }

                $user->save();

                // Atualiza os papéis
                if (isset($changes['roles'])) {
                    $user->syncRoles($changes['roles']);
                }
            } else {
                $updated = false;
            }

            DB::commit();
            Log::info('Perfil editado.', ['id' => $user->id]);

            if (!$updated) {
                return redirect()->route('user.edit', ['user' => $user])->with('info', 'Nenhuma alteração realizada!');
            } else {
                return redirect()->route('user.show', ['user' => $user])->with('success', 'Informações do operador editadas com sucesso!');
            }

        } catch (\Exception $e) {
            Log::error('Perfil não editado.', ['error' => $e->getMessage()]);
            DB::rollBack();

            return back()->withInput()->with('error', 'Perfil não editado!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
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
}
