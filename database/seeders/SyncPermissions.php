<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SyncPermissions extends Seeder
{
    public function run(): void
    {

        $roles = Role::create(['Writer', 'Admin', 'Superadmin', 'guest']);
    }
}
