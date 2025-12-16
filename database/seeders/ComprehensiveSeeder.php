<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComprehensiveSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the comprehensive database seeding with all enhanced data.
     */
    public function run(): void
    {
        $this->command->info('Starting comprehensive database seeding...');

        // Seed departments first
        $this->command->info('Seeding departments...');
        $this->call(EnhancedDepartmentSeeder::class);

        // Seed users
        $this->command->info('Seeding users...');
        $this->call(EnhancedUserSeeder::class);

        // Seed tasks
        $this->command->info('Seeding tasks...');
        $this->call(EnhancedTaskSeeder::class);

        // Seed comments
        $this->command->info('Seeding comments...');
        $this->call(CommentSeeder::class);

        // Seed reports
        $this->command->info('Seeding reports...');
        $this->call(EnhancedReportSeeder::class);

        // Seed system parameters
        $this->command->info('Seeding system parameters...');
        $this->call(SystemParameterSeeder::class);

        $this->command->info('✅ Comprehensive seeding completed successfully!');
    }
}
