<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $superAdminRole = Role::where('name', 'SuperAdmin')->first();
        $adminRole = Role::where('name', 'Admin')->first();
        $clienteRole = Role::where('name', 'Cliente')->first();

        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@superadmin.com',
            'password' => Hash::make('password')
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')
        ]);

        $cliente = User::create([
            'name' => 'Cliente',
            'email' => 'cliente@cliente.com',
            'password' => Hash::make('password')
        ]);

        $superAdmin->roles()->attach($superAdminRole);
        $admin->roles()->attach($adminRole);
        $cliente->roles()->attach($clienteRole);
    }
}
