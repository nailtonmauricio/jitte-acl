<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\FailedLogin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Exception;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('modules.login.index');
    }

    /**
     *  Process a login action
     */
    public function login(LoginRequest $request)
    {
        $request->validated();

        try {
            // Verifica se o usuário está bloqueado antes de tentar autenticar
            $ip = $request->ip();
            $email = $request->email;
            $user = User::where('email', $email)->first();
            $cacheKey = 'login_attempts_' . $ip . '_' . ($user ? $user->id : 'guest');
            $attempts = Cache::get($cacheKey, 0);

            if ($attempts >= 5) {
                return back()->withInput()->with('error', 'Muitas tentativas de realizar login. Por favor, tente mais tarde.');
            }

            $authenticated = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

            if (!$authenticated) {
                $this->sendFailedLoginResponse($request, $user);

                Log::warning('Erro na tentativa de efetuar login.', ['email' => $request->email]);
                return back()->withInput()->with('error', 'Usuário ou senha inválidos');
            }

            // Se o login for bem-sucedido, reseta o contador de tentativas
            $this->authenticated($request, Auth::user());

            if ($user->hasRole('Root')) {
                $permissions = Permission::pluck('name')->toArray();
            } else {
                $permissions = $user->getPermissionsViaRoles()->pluck('name')->toArray();
            }

            $user->syncPermissions($permissions);

            return redirect()->route('home.index');

        } catch (Exception $e) {
            Log::error('Erro ao tentar efetuar login.', ['email' => $request->email, 'exception' => $e]);
            return back()->withInput()->with('error', 'Ocorreu um erro ao tentar efetuar o login. Por favor, tente novamente.');
        }
    }

    /**
     * @param Request $request
     * @param User|null $user
     * @return \Illuminate\Http\RedirectResponse
     * Register a failed login attempt
     */
    protected function sendFailedLoginResponse(Request $request, $user = null)
    {
        $ip = $request->ip();
        $cacheKey = 'login_attempts_' . $ip . '_' . ($user ? $user->id : 'guest');
        $attempts = Cache::get($cacheKey, 0);
        $attempts++;
        Cache::put($cacheKey, $attempts, now()->addMinutes(15)); // Bloqueia por 15 minutos

        FailedLogin::create([
            'user_id' => $user ? $user->id : null,
            'ip_address' => $request->ip(),
            'attempted_at' => now(),
        ]);

        if ($attempts >= 5) { // Bloqueia após 5 tentativas
            return back()->withInput()->with('error', 'Muitas tentativas de realizar login. Por favor, tente mais tarde.');
        }

        Log::warning('Erro na tentativa de efetuar login.', ['email' => $request->email]);
        return back()->withInput()->with('error', 'Usuário ou senha inválidos');
    }

    /**
     * @param Request $request
     * @param $user
     */
    protected function authenticated(Request $request, $user)
    {
        $ip = $request->ip();
        $cacheKey = 'login_attempts_' . $ip . '_' . $user->id;
        Cache::forget($cacheKey); // Reseta o contador de tentativas após login bem-sucedido
    }
}
