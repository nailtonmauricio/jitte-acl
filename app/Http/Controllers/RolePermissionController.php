<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    /**
     * Display a list of resource.
     */
    public function index(Role $role)
    {
        $loggedUser = auth()->user();
        $loggedUserRole = $loggedUser->roles()->pluck('role_id')->first();

        if ($role->name == 'root') {
            Log::info('Acesso negado', ['user_id' => Auth::id()]);
            return redirect()->route('role.index')->with('error', 'Acesso negado');
        }

        if ($loggedUserRole >= $role->id) {
            Log::info('Acesso negado', ['user_id' => Auth::id()]);
            return redirect()->route('role.index')->with('error', 'Acesso negado');
        }

        Log::info('Listar permissões do nível de acesso', ['role_id' => $role->id, 'user_id' => Auth::id()]);

        // Carregar a view
        return view('modules.role-permission.index', [
            'menu' => 'niveis-acesso',
            'role' => $role,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //IMPLEMENTAR AQUI OS LOGS E AUDITORIAS DEPOIS
        if ($request->statusPermission == 1) {
            $role->givePermissionTo($request->permission);

            return redirect()->back()->with('success', 'Permissão concedida com sucesso.');
        } else {
            $role->revokePermissionTo($request->permission);

            return redirect()->back()->with('success', 'Permissão revogada com sucesso.');
        }
    }

    /**
     * @param Role $role
     * @param Request $request
     * @return \Illuminate\Container\Container|mixed|object
     * Search for a specific term in a role-permission table
     */
    //USADO SEM O LIVEWIRE
    /*public function search(Role $role, Request $request)
    {
        $searchTerm = $request->input('searchTerm'); // Recupera o termo de pesquisa

        $loggedUser = auth()->user();
        $loggedUserRole = $loggedUser->roles()->pluck('role_id')->first();

        // Verifica se o acesso é permitido
        if ($role->name == 'root') {
            Log::info('Acesso negado', ['user_id' => Auth::id()]);
            return redirect()->route('role.index')->with('error', 'Acesso negado');
        }

        if ($loggedUserRole >= $role->id) {
            Log::info('Acesso negado', ['user_id' => Auth::id()]);
            return redirect()->route('role.index')->with('error', 'Acesso negado');
        }

        // Recupera as permissões do nível de acesso
        $rolePermissions = $role->permissions()->pluck('id')->toArray();

        // Realiza a busca nas permissões com like
        $permissions = Permission::where(function($query) use ($searchTerm) {
            $query->where('name', 'like', '%'.$searchTerm.'%')
                ->orWhere('description', 'like', '%'.$searchTerm.'%');
        })->paginate(8);

        Log::info('Listar permissões do nível de acesso', ['role_id' => $role->id, 'user_id' => Auth::id()]);

        // Carregar a view
        return view('modules.role-permission.index', [
            'menu' => 'niveis-acesso',
            'rolePermissions' => $rolePermissions,
            'permissions' => $permissions,
            'role' => $role,
            'searchTerm' => $searchTerm, // Passa o termo de busca para a view
        ]);
    }*/
}
