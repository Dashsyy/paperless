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

        // foreach ($permissions as $permission) {
        //     Permission::create($permission);
        // }

        Role::findOrCreate(RoleEnum::SuperAdmin->value);

        // // Assign all permissions to admin role
        $adminRole = Role::where('name', 'SuperAdmin')->first();
        $adminRole->givePermissionTo(Permission::all());

    }
}
