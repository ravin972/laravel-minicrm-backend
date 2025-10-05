<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Enums\PermissionEnum;
use App\RoleEnum;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions if they don't exist
        Permission::firstOrCreate(['name' => PermissionEnum::MANAGE_USERS->value]);
        Permission::firstOrCreate(['name' => PermissionEnum::DELETE_CLIENTS->value]);
        Permission::firstOrCreate(['name' => PermissionEnum::DELETE_PROJECTS->value]);
        Permission::firstOrCreate(['name' => PermissionEnum::DELETE_TASKS->value]);

        // Find admin role and sync permissions
        $role = Role::findByName(RoleEnum::ADMIN->value);
        $role->syncPermissions([
            PermissionEnum::MANAGE_USERS->value,
            PermissionEnum::DELETE_CLIENTS->value,  
            PermissionEnum::DELETE_PROJECTS->value,
            PermissionEnum::DELETE_TASKS->value,
        ]);
    }
}
