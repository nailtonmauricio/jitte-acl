<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login.index')->with('success', 'Operador desconectado com sucesso');
    }
}
