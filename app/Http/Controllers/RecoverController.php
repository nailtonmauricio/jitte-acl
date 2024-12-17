<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class RecoverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('modules.recover.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function process(Request $request)
    {
        $request->validate(
            [
                'email'=>'required|email',
            ],
            [
                'email.required'=>'O e-mail é obrigatório.',
                'email.email' => 'Você deve informar um e-mail válido.'
            ]
        );

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            Log::warning('Tentativa de recuperação de senha com e-mail não cadastrado', ['email'=>$request->email]);

            return back()->withInput()->with('error', 'E-mail não encontrado.');
        }

        try {
            Password::sendResetLink(
                $status = $request->only('email')
            );

            Log::info('Solicitação de recuperação de senha realizado com sucesso.', ['status'=>$status, 'email'=>$request->email]);

            return redirect()->route('login.index')->with('success', 'E-mail de recuperação de senha enviado com sucesso. Verifique sua caixa e entrada');

        } catch (Exception $e) {
            Log::warning('Erro ao tentar recuperar senha.', ['error'=>$e->getMessage(), 'email'=>$request->email]);

            return back()->withInput()->with('warning', 'Tentativa de recuperação de e-mail que não existe na base de dados.');
        }
    }

    /**
     *
     */
    public function reset(Request $request)
    {
        return view('modules.recover.edit', ['token'=>$request->token, 'email'=>$request->email]);

    }

    /**
     *
     */
    public function update(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:users',
            'password'=>'required|min:6|confirmed',
        ]);

        try {
            $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user, string $password)
                {
                    $user->forceFill([
                        'password'=>Hash::make($password)
                    ]);

                    $user->save();
                }
            );

            Log::info('Atualização de senha', ['resposta'=>$status, 'email'=>$request->email]);

            return $status === Password::PASSWORD_RESET ? redirect()->route('login.index')->with('success', 'Senha atualizada com sucesso.') : redirect()->route('login.index')->with('error', __($status));
        } catch (Exception $e) {
            Log::warning('Erro na atualização de senha.', ['error'=>$e->getMessage(), 'email'=>$request->email]);

            return back()->withInput()->with('error', 'Algo deu errado, informe o Administrador.');
        }
    }
}
