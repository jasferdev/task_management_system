<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed in order of dependencies
        $this->call([
            DepartmentSeeder::class,
            UserSeeder::class,
            TaskSeeder::class,
            CommentSeeder::class,
            ReportSeeder::class,
            SystemParameterSeeder::class,
        ]);
    }
}
