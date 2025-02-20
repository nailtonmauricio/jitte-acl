<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('modules.profile.edit', ['menu'=>'operadores', 'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request)
    {
        $user = Auth::user();
        $updated = false;
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $changes = [];

            if ($user->name != $validated['name']) {
                $changes['name'] = $validated['name'];
            }

            if ($user->email != $validated['email']) {
                $changes['email'] = $validated['email'];
            }

            if (!empty($validated['password']) && !password_verify($validated['password'], $user->password)) {
                $changes['password'] = bcrypt($validated['password']);
            }

            if (!empty($changes)) {
                $updated = true;
                $user->update($changes);
            }

            DB::commit();
            Log::info('Perfil editado.', ['id' => $user->id]);

            if (!$updated) {
                return redirect()->route('profile.edit')->with('info', 'Nenhuma alteração realizada!');
            } else {
                return redirect()->route('profile.edit', ['user' => $user])->with('success', 'Perfil editado com sucesso!');
            }

        } catch (Exception $e) {
            Log::info('Perfil não editado.', ['error' => $e->getMessage()]);
            DB::rollBack();

            return back()->withInput()->with('error', 'Perfil não editado!');
        }
    }
}
