<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        //-- Limpiar caché de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //-- Crear permisos
        Permission::create(['name' => 'view tasks']);
        Permission::create(['name' => 'create tasks']);
        Permission::create(['name' => 'edit tasks']);
        Permission::create(['name' => 'delete tasks']);
        Permission::create(['name' => 'view users']);

        //-- Crear roles
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);
        $userRole = Role::create(['name' => 'user']);

        //-- Asignar permisos a roles
        $admin->givePermissionTo(Permission::all());

        $editor->givePermissionTo([
            'view tasks',
            'create tasks',
            'edit tasks',
            'delete tasks'
        ]);

        $userRole->givePermissionTo([
            'view tasks'
        ]);

        //-- Crear usuarios demo

        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => Hash::make('password')
        ]);
        $adminUser->assignRole('admin');

        $editorUser = User::create([
            'name' => 'Editor User',
            'email' => 'editor@test.com',
            'password' => Hash::make('password')
        ]);
        $editorUser->assignRole('editor');

        $normalUser = User::create([
            'name' => 'Normal User',
            'email' => 'user@test.com',
            'password' => Hash::make('password')
        ]);
        $normalUser->assignRole('user');
    }
}