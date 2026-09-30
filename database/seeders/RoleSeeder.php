<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)
            ->forgetCachedPermissions();

        Role::upsert(
            [
                [
                    'name' => 'admin',
                    'guard_name' => 'web',
                ],
            ],
            ['name', 'guard_name'],
            []
        );

        $admin = Role::findByName('admin', 'web');

        $admin->givePermissionTo([
            'dashboard.view',

            'user.view',
            'user.create',
            'user.update',
            'user.delete',
            
            'bank-sampah.view',
            'bank-sampah.create',
            'bank-sampah.update',
            'bank-sampah.delete',
        ]);

        app(PermissionRegistrar::class)
            ->forgetCachedPermissions();
    }
}
