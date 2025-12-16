<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EnhancedReportSeeder extends Seeder
{
    /**
     * Run the database seeds with enhanced report data.
     */
    public function run(): void
    {
        $admin = User::where('Email', 'admin@taskmgmt.com')->first();
        $itManager = User::where('Email', 'it.manager@taskmgmt.com')->first();

        $reports = [
            [
                'Title' => 'Weekly Project Status Report',
                'CreatedBy' => $admin->UserID ?? 1,
                'DateGenerated' => Carbon::now(),
            ],
            [
                'Title' => 'IT Department Performance Report',
                'CreatedBy' => $itManager->UserID ?? 3,
                'DateGenerated' => Carbon::now(),
            ],
            [
                'Title' => 'Monthly Task Completion Report',
                'CreatedBy' => $admin->UserID ?? 1,
                'DateGenerated' => Carbon::now()->subDays(7),
            ],
            [
                'Title' => 'Q4 Project Summary',
                'CreatedBy' => $itManager->UserID ?? 3,
                'DateGenerated' => Carbon::now()->subDays(30),
            ],
            [
                'Title' => 'Resource Allocation Report',
                'CreatedBy' => $admin->UserID ?? 1,
                'DateGenerated' => Carbon::now()->subDays(14),
            ],
        ];

        foreach ($reports as $report) {
            Report::firstOrCreate(
                [
                    'Title' => $report['Title'],
                    'CreatedBy' => $report['CreatedBy'],
                ],
                $report
            );
        }
    }
}
