<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // RoleEnum
        foreach (RoleEnum::cases() as $role) {
            Role::findOrCreate($role->value);
        }

        foreach (RoleEnum::cases() as $role) {
            User::factory()->create([
                'name' => $role->value,
                'email' => $role->value.'@paperless.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ])->assignRole($role);
        }
    }
}
