<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class SyncPermissions extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        foreach (PermissionEnum::cases() as $key => $permission) {
            Permission::findOrCreate($permission->value);
        }

        foreach (RoleEnum::cases() as $role) {
            Role::findOrCreate($role->value);
        }

        // Assign all permissions to admin role
    }
}
