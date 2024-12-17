<?php

namespace App\Http\Controllers;

use App\Models\FailedLogin;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Root')) {
            $loginAttemptsData = self::loginAttempts();
            return view('modules.home.root.index', array_merge(['menu' => 'inicio'], $loginAttemptsData));
        } elseif ($user->hasRole('Admin')) {
            return view('modules.home.admin.index', ['menu' => 'inicio']);
        } else {
            return view('modules.home.default.index', ['menu' => 'inicio']);
        }
    }

    public static function loginAttempts()
    {
        $loginAttempts = FailedLogin::selectRaw('DATE(attempted_at) as date, COUNT(*) as attempts')
            ->groupBy('date')
            ->get();

        return ['loginAttempts' => $loginAttempts];
    }
}

