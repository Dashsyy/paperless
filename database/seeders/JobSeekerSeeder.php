<?php

namespace Database\Seeders;

use App\Models\Jobseeker;
use Database\Factories\JobseekerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
