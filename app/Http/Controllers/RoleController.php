<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedUser = auth()->user(); // Obtém o usuário autenticado
        $loggedUserRole = $loggedUser->roles()->first(); // Obtém a primeira role do usuário

        if (!$loggedUserRole) {
            abort(403, 'Usuário sem papel associado');
        }

        $roles = Role::where('name', '!=', 'root')
            ->where('id', '!=', $loggedUserRole->id)
            ->where('order_roles', '>', $loggedUserRole->order_roles)
            ->paginate(8);

        return view('modules.role.index', [
            'menu' => 'niveis-acesso',
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.role.create', ['menu' => 'niveis-acesso']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        DB::beginTransaction();
        try {
            Role::create([
                'name' => $request->name,
                'guard_name' => $request->guard_name,
                'order_roles' => $request->order_roles
            ]);

            DB::commit();
            return redirect()->route('role.index')->with('success', 'Novo nível de acesso criado com sucesso.');
        } catch (Exception $e) {
            Log::debug('Erro ao cadastrar nível de acesso.', ['error' => $e->getMessage()]);

            DB::rollBack();
            return back()->withInput()->with('error', 'Problemas ocorreram ao tentar cadastrar o nível de acesso, informe o administrador do sistema!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('modules.role.edit', compact('role'), ['menu' => 'niveis-acesso']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $updated = false;
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $changes = [];

            if ($role->name != $validated['name']) {
                $changes['name'] = $validated['name'];
                $updated = true;
            }

            if ($role->guard_name != $validated['guard_name']) {
                $changes['guard_name'] = $validated['guard_name'];
                $updated = true;
            }

            if ($role->order_roles != $validated['order_roles']) {
                $changes['order_roles'] = $validated['order_roles'];
                $updated = true;
            }

            $role->update(
                $changes
            );

            DB::commit();

            if (!$updated) {
                return redirect()->route('role.edit', ['role' => $role->id])->with('info', 'Nenhuma alteração realizada!');
            } else {
                return redirect()->route('role.edit', ['role' => $role->id])->with('success', 'Atualização realizada com sucesso');
            }
        } catch (Exception $e) {
            Log::error('Nível de acesso não editado.', ['error' => $e->getMessage()]);
            DB::rollBack();

            return back()->withInput()->with('error', 'Nível de acesso não editado!');
        }
    }
}
