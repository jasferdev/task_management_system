<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::where('Email', 'admin@example.com')->first();
        $johnUser = User::where('Email', 'john@example.com')->first();
        $janeUser = User::where('Email', 'jane@example.com')->first();
        $bobUser = User::where('Email', 'bob@example.com')->first();
        $aliceUser = User::where('Email', 'alice@example.com')->first();

        $itDept = Department::where('DepartmentName', 'IT')->first();
        $hrDept = Department::where('DepartmentName', 'Human Resources')->first();
        $financeDept = Department::where('DepartmentName', 'Finance')->first();

        $tasks = [
            [
                'Title' => 'Setup Development Environment',
                'Description' => 'Configure development environment with necessary tools and dependencies',
                'Priority' => 'high',
                'Status' => 'in_progress',
                'Deadline' => now()->addDays(3),
                'CreatedBy' => $adminUser->UserID ?? 1,
                'AssignedTo' => $johnUser->UserID ?? 2,
                'DepartmentID' => $itDept->DepartmentID ?? 1,
            ],
            [
                'Title' => 'Fix Database Connection Bug',
                'Description' => 'There is a connection timeout issue in the database module',
                'Priority' => 'critical',
                'Status' => 'in_progress',
                'Deadline' => now()->addDay(),
                'CreatedBy' => $johnUser->UserID ?? 2,
                'AssignedTo' => $bobUser->UserID ?? 4,
                'DepartmentID' => $itDept->DepartmentID ?? 1,
            ],
            [
                'Title' => 'Create User Documentation',
                'Description' => 'Write comprehensive documentation for end users',
                'Priority' => 'medium',
                'Status' => 'pending',
                'Deadline' => now()->addDays(7),
                'CreatedBy' => $adminUser->UserID ?? 1,
                'AssignedTo' => $janeUser->UserID ?? 3,
                'DepartmentID' => $hrDept->DepartmentID ?? 2,
            ],
            [
                'Title' => 'Update Financial Reports',
                'Description' => 'Prepare Q4 financial reports and analysis',
                'Priority' => 'high',
                'Status' => 'pending',
                'Deadline' => now()->addDays(5),
                'CreatedBy' => $adminUser->UserID ?? 1,
                'AssignedTo' => $bobUser->UserID ?? 4,
                'DepartmentID' => $financeDept->DepartmentID ?? 3,
            ],
            [
                'Title' => 'Implement API Rate Limiting',
                'Description' => 'Add rate limiting to prevent API abuse',
                'Priority' => 'medium',
                'Status' => 'pending',
                'Deadline' => now()->addDays(10),
                'CreatedBy' => $johnUser->UserID ?? 2,
                'AssignedTo' => $johnUser->UserID ?? 2,
                'DepartmentID' => $itDept->DepartmentID ?? 1,
            ],
            [
                'Title' => 'Team Meeting - Project Status',
                'Description' => 'Quarterly meeting to discuss project status and roadmap',
                'Priority' => 'medium',
                'Status' => 'completed',
                'Deadline' => now()->subDays(1),
                'CreatedBy' => $adminUser->UserID ?? 1,
                'AssignedTo' => $aliceUser->UserID ?? 5,
                'DepartmentID' => $itDept->DepartmentID ?? 1,
            ],
            [
                'Title' => 'Security Audit',
                'Description' => 'Perform security audit and vulnerability assessment',
                'Priority' => 'critical',
                'Status' => 'in_progress',
                'Deadline' => now()->addDays(2),
                'CreatedBy' => $adminUser->UserID ?? 1,
                'AssignedTo' => null,
                'DepartmentID' => $itDept->DepartmentID ?? 1,
            ],
        ];

        foreach ($tasks as $task) {
            Task::firstOrCreate(
                ['Title' => $task['Title'], 'CreatedBy' => $task['CreatedBy']],
                $task
            );
        }
    }
}
