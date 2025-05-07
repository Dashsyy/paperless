<?php

namespace Database\Seeders;

use App\Models\Jobseeker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(
            [
            SyncPermissions::class,
            UserSeeder::class,
            SeekerSeeder::class,
            JobSeekerSeeder::class
            ]
        );
    }
}
