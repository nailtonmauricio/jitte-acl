<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'home-index',
                'description' => 'Carrega a dashboard contendo as informações iniciais do sistema de acordo com o nível de acesso do operador',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'profile-edit',
                'description' => 'Carrega as informações do operador logado, sendo utilizada para atualizações do perfil',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'role-index',
                'description' => 'Lista dos níveis de acesso registradas na base de dados',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'role-update',
                'description' => 'Realiza os bloqueios e liberações das rotas',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'user-index',
                'description' => 'Lista de operadores cadastrados',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'user-create',
                'description' => 'Formulário de registro para novos operadores',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'user-show',
                'description' => 'Apresentação das informações do registro de um operador',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'user-edit',
                'description' => 'Formulário para edição de informações do operador',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'user-destroy',
                'description' => 'Remover registro de operador',
                'guard_name'=> 'web',
            ],
        ];

        foreach ($permissions as $permission) {
            $existingPermission = Permission::where('name', $permission['name'])->first();

            if (!$existingPermission) {
                Permission::create([
                    'name' => $permission['name'],
                    'description' => $permission['description'],
                    'guard_name' => $permission['guard_name'],
                ]);
            }
        }
    }
}
