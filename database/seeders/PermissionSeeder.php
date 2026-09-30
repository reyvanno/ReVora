<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)
            ->forgetCachedPermissions();

        $permissions = [
            //Dashboard
            'dashboard.view',

            //User
            'user.view',
            'user.create',
            'user.update',
            'user.delete',

            //Bank Sampah
            'bank-sampah.view',
            'bank-sampah.create',
            'bank-sampah.update',
            'bank-sampah.delete',
        ];

        $data = collect($permissions)
            ->map(fn (string $permission) => [
                'name' => $permission,
                'guard_name' => 'web',
            ])
            ->toArray();

        Permission::upsert(
            $data,
            ['name', 'guard_name'],
            []
        );

        app(PermissionRegistrar::class)
            ->forgetCachedPermissions();
    }
}
