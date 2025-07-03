<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Role::create(['name' => 'superadmin']);
        Role::create(['name' => 'admin_desa']);
        Role::create(['name' => 'admin_kabupaten']);

        // Superadmin
        $superadmin = User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'telephone' => '085876550051',
            'email_verified_at' => now(),
            'password' => bcrypt('superadmin'),
            'role' => 'superadmin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $superadmin->assignRole('superadmin');

        // Buat user admin desa
        $adminDesa = User::create([
            'name' => 'Admin Desa',
            'email' => 'admin_desa@gmail.com',
            'telephone' => '085876550051',
            'email_verified_at' => now(),
            'password' => bcrypt('admindesa'),
            'role' => 'admin_desa',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        $adminDesa->assignRole('admin_desa');
        // Buat user admin
        $admin = User::create([
            'name' => 'Admin Kabupaten',
            'email' => 'admin_kab@gmail.com',
            'telephone' => '085876550051',
            'email_verified_at' => now(),
            'password' => bcrypt('adminkab'),
            'role' => 'admin_kabupaten',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        $admin->assignRole('admin_kabupaten');
    }
}
