<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::where('Email', 'admin@example.com')->first();
        $johnUser = User::where('Email', 'john@example.com')->first();

        $reports = [
            [
                'Title' => 'Weekly Progress Report - Week 1',
                'CreatedBy' => $adminUser->UserID ?? 1,
                'DateGenerated' => now()->subDays(3),
            ],
            [
                'Title' => 'Monthly Status Report - December 2025',
                'CreatedBy' => $johnUser->UserID ?? 2,
                'DateGenerated' => now()->subDay(),
            ],
            [
                'Title' => 'Q4 Development Summary',
                'CreatedBy' => $adminUser->UserID ?? 1,
                'DateGenerated' => now(),
            ],
        ];

        foreach ($reports as $report) {
            Report::firstOrCreate(
                ['Title' => $report['Title']],
                $report
            );
        }
    }
}
