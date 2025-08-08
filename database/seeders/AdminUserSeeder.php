<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear el usuario admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('3d1f6d8b4d31a'),
            ]
        );

        // Crear el rol admin si no existe
        $role = Role::firstOrCreate(['name' => 'admin']);

        // Asignar el rol al usuario
        $admin->assignRole($role);
    }
}