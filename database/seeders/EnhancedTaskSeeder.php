<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EnhancedTaskSeeder extends Seeder
{
    /**
     * Run the database seeds with enhanced task data.
     */
    public function run(): void
    {
        $it = Department::where('DepartmentName', 'LIKE', '%IT%')->first();
        $hr = Department::where('DepartmentName', 'LIKE', '%Human Resources%')->first();
        $sales = Department::where('DepartmentName', 'LIKE', '%Sales%')->first();

        $admin = User::where('Email', 'admin@taskmgmt.com')->first();
        $itManager = User::where('Email', 'it.manager@taskmgmt.com')->first();
        $alice = User::where('Email', 'alice@taskmgmt.com')->first();
        $bob = User::where('Email', 'bob@taskmgmt.com')->first();

        $tasks = [
            [
                'Title' => 'Setup Development Environment',
                'Description' => 'Configure development environment with all required tools and dependencies',
                'Priority' => 'critical',
                'Status' => 'in_progress',
                'CreatedBy' => $admin->UserID ?? 1,
                'AssignedTo' => $alice->UserID ?? 3,
                'DepartmentID' => $it->DepartmentID ?? 1,
                'Deadline' => Carbon::now()->addDays(3),
            ],
            [
                'Title' => 'Code Review - Authentication Module',
                'Description' => 'Review and provide feedback on the new authentication module implementation',
                'Priority' => 'high',
                'Status' => 'pending',
                'CreatedBy' => $itManager->UserID ?? 3,
                'AssignedTo' => $bob->UserID ?? 4,
                'DepartmentID' => $it->DepartmentID ?? 1,
                'Deadline' => Carbon::now()->addDays(2),
            ],
            [
                'Title' => 'Database Optimization',
                'Description' => 'Optimize database queries and indexes for better performance',
                'Priority' => 'high',
                'Status' => 'pending',
                'CreatedBy' => $admin->UserID ?? 1,
                'AssignedTo' => $alice->UserID ?? 3,
                'DepartmentID' => $it->DepartmentID ?? 1,
                'Deadline' => Carbon::now()->addDays(7),
            ],
            [
                'Title' => 'Write Unit Tests',
                'Description' => 'Write comprehensive unit tests for all API endpoints',
                'Priority' => 'medium',
                'Status' => 'pending',
                'CreatedBy' => $itManager->UserID ?? 3,
                'AssignedTo' => $bob->UserID ?? 4,
                'DepartmentID' => $it->DepartmentID ?? 1,
                'Deadline' => Carbon::now()->addDays(5),
            ],
            [
                'Title' => 'Fix Critical Bug in Dashboard',
                'Description' => 'Fix the critical bug causing dashboard to crash when loading large datasets',
                'Priority' => 'critical',
                'Status' => 'completed',
                'CreatedBy' => $admin->UserID ?? 1,
                'AssignedTo' => $alice->UserID ?? 3,
                'DepartmentID' => $it->DepartmentID ?? 1,
                'Deadline' => Carbon::now()->subDays(2),
            ],
            [
                'Title' => 'Implement User Role Management',
                'Description' => 'Implement comprehensive user role and permission management system',
                'Priority' => 'high',
                'Status' => 'in_progress',
                'CreatedBy' => $itManager->UserID ?? 3,
                'AssignedTo' => $bob->UserID ?? 4,
                'DepartmentID' => $it->DepartmentID ?? 1,
                'Deadline' => Carbon::now()->addDays(10),
            ],
            [
                'Title' => 'Update API Documentation',
                'Description' => 'Update API documentation with new endpoints and parameters',
                'Priority' => 'medium',
                'Status' => 'pending',
                'CreatedBy' => $admin->UserID ?? 1,
                'AssignedTo' => null,
                'DepartmentID' => $it->DepartmentID ?? 1,
                'Deadline' => Carbon::now()->addDays(4),
            ],
            [
                'Title' => 'Security Audit',
                'Description' => 'Conduct comprehensive security audit of the application',
                'Priority' => 'critical',
                'Status' => 'pending',
                'CreatedBy' => $itManager->UserID ?? 3,
                'AssignedTo' => $alice->UserID ?? 3,
                'DepartmentID' => $it->DepartmentID ?? 1,
                'Deadline' => Carbon::now()->addDays(14),
            ],
        ];

        foreach ($tasks as $task) {
            Task::firstOrCreate(
                [
                    'Title' => $task['Title'],
                    'CreatedBy' => $task['CreatedBy'],
                ],
                $task
            );
        }
    }
}
