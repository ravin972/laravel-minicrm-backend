<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\RoleEnum;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();
        User::factory()->create([
            'full_name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password',
        ])->syncRoles([RoleEnum::ADMIN]);
    }
}
