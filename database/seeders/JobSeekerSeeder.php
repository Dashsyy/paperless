<?php

namespace Database\Seeders;

use App\Models\Jobseeker;
use Illuminate\Database\Seeder;

class JobSeekerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jobseeker::factory()->count(20)->create();
    }
}
