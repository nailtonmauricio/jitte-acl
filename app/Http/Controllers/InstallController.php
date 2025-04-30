<?php

namespace App\Http\Controllers;

use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InstallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('modules.install.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
           'app_name' => 'required',
           'db_host' => 'required',
           'db_port' => 'required',
           'db_name' => 'required',
           'db_user' => 'required',
           'db_pass' => 'required',
           'admin_email' => 'required|email',
           'admin_pass' => 'required|min:6',
        ]);

        // Cria ou sobrescreve o .env
        $envData = [
            "APP_NAME=\"{$request->app_name}\"",
            "DB_CONNECTION=mysql",
            "DB_HOST={$request->db_host}",
            "DB_PORT={$request->db_port}",
            "DB_DATABASE={$request->db_name}",
            "DB_USERNAME={$request->db_user}",
            "DB_PASSWORD=\"{$request->db_pass}\"",
        ];

        File::put(base_path('.env'), implode("\n", $envData));
        Artisan::call('config:clear');

        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            Log::error('Erro ao conectar ao banco de dados.', ['db_host' => $request->db_host, 'exception' => $e]);
            return back()->withErrors(['error' => 'Erro ao conectar ao banco de dados']);
        }

        Artisan::call('migrate:fresh --seed');

        File::put(storage_path('installed.lock'), now()->toDayDateTimeString());

        return redirect('/login')->with('success', 'Sistema instalado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
