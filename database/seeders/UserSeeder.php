<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::upsert(
            [
                'name' => 'Administrator',
                'email' => 'admin@revora.test',
                'password' => Hash::make('password'),
            ],
            ['email'],
            ['name', 'password']
        );

        User::where('email', 'admin@revora.test')
            ->firstOrFail()
            ->syncRoles('admin');
    }
}
