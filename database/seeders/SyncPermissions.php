<?php

namespace Database\Seeders;

use App\Enums\Permissions\JobseekerPermission;
use App\Enums\Permissions\SeekerPermission;
use App\Enums\Permissions\UserPermission;
use App\Enums\Permissions\WorkHistoryPermission;
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

        /**
         * Load permission and create
         */
        foreach (UserPermission::cases() as $permission) {
            Permission::findOrCreate($permission->value);
        }

        foreach (JobseekerPermission::cases() as $permission) {
            Permission::findOrCreate($permission->value);
        }

        foreach (WorkHistoryPermission::cases() as $permission) {
            Permission::findOrCreate($permission->value);
        }

        foreach (SeekerPermission::cases() as $permission) {
            Permission::findOrCreate($permission->value);
        }

        /**
         * End of loading permission and create
         */

        /**
         * Sync permissions to Admin role
         *
         * @see RoleEnum\Admin
         */
        Role::findOrCreate(RoleEnum::Admin->value)->syncPermissions(
            [
                UserPermission::viewAnyUser->value,
                UserPermission::viewUser->value,
                UserPermission::createUser->value,
                UserPermission::updateUser->value,

                JobseekerPermission::viewAnyJobseeker->value,
                JobseekerPermission::viewJobseeker->value,
                JobseekerPermission::createJobseeker->value,
                JobseekerPermission::updateJobseeker->value,

                WorkHistoryPermission::viewAnyWorkHistory->value,
                WorkHistoryPermission::viewWorkHistory->value,
                WorkHistoryPermission::createWorkHistory->value,
                WorkHistoryPermission::updateWorkHistory->value,

                SeekerPermission::viewAnySeeker->value,
                SeekerPermission::viewSeeker->value,
            ]
        );

        /**
         * Sync permissions to Editor role
         *
         * @see RoleEnum\Editor
         */
        Role::findOrCreate(RoleEnum::Editor->value)->syncPermissions(
            [
                JobseekerPermission::viewAnyJobseeker->value,
                JobseekerPermission::viewJobseeker->value,
                JobseekerPermission::updateJobseeker->value,

                WorkHistoryPermission::viewAnyWorkHistory->value,
                WorkHistoryPermission::viewWorkHistory->value,
                WorkHistoryPermission::updateWorkHistory->value,

                SeekerPermission::viewAnySeeker->value,
                SeekerPermission::viewSeeker->value,
            ]
        );
    }
}
