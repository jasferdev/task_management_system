<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\User;
use App\Models\Task;
use App\Models\Comment;
use App\Models\Report;
use App\Models\SystemParameter;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if data already exists to avoid duplicates
        if (Department::where('DepartmentName', 'IT')->exists()) {
            echo "Test data already exists. Skipping seeding...\n";
            return;
        }

        // Create departments
        $dept1 = Department::create(['DepartmentName' => 'IT']);
        $dept2 = Department::create(['DepartmentName' => 'HR']);
        $dept3 = Department::create(['DepartmentName' => 'Finance']);

        // Create users
        $user1 = User::create([
            'Name' => 'John Admin',
            'Email' => 'john@example.com',
            'Role' => 'admin',
            'Status' => 'active',
            'DepartmentID' => $dept1->DepartmentID,
            'password' => bcrypt('password123')
        ]);

        $user2 = User::create([
            'Name' => 'Jane Manager',
            'Email' => 'jane@example.com',
            'Role' => 'manager',
            'Status' => 'active',
            'DepartmentID' => $dept1->DepartmentID,
            'password' => bcrypt('password123')
        ]);

        $user3 = User::create([
            'Name' => 'Bob User',
            'Email' => 'bob@example.com',
            'Role' => 'user',
            'Status' => 'active',
            'DepartmentID' => $dept2->DepartmentID,
            'password' => bcrypt('password123')
        ]);

        $user4 = User::create([
            'Name' => 'Alice User',
            'Email' => 'alice@example.com',
            'Role' => 'user',
            'Status' => 'active',
            'DepartmentID' => $dept3->DepartmentID,
            'password' => bcrypt('password123')
        ]);

        // Create tasks
        $task1 = Task::create([
            'Title' => 'Fix Database Connection',
            'Description' => 'Resolve the database connectivity issue in the staging environment.',
            'Priority' => 'critical',
            'Status' => 'in_progress',
            'Deadline' => now()->addDays(3),
            'CreatedBy' => $user1->UserID,
            'AssignedTo' => $user2->UserID,
            'DepartmentID' => $dept1->DepartmentID
        ]);

        $task2 = Task::create([
            'Title' => 'Update Employee Records',
            'Description' => 'Update the Q4 employee records in the HR system.',
            'Priority' => 'high',
            'Status' => 'pending',
            'Deadline' => now()->addDays(7),
            'CreatedBy' => $user1->UserID,
            'AssignedTo' => $user3->UserID,
            'DepartmentID' => $dept2->DepartmentID
        ]);

        $task3 = Task::create([
            'Title' => 'Financial Report Preparation',
            'Description' => 'Prepare the quarterly financial report.',
            'Priority' => 'medium',
            'Status' => 'pending',
            'Deadline' => now()->addDays(10),
            'CreatedBy' => $user1->UserID,
            'AssignedTo' => $user4->UserID,
            'DepartmentID' => $dept3->DepartmentID
        ]);

        $task4 = Task::create([
            'Title' => 'Code Review',
            'Description' => 'Review the latest pull requests from the development team.',
            'Priority' => 'high',
            'Status' => 'completed',
            'Deadline' => now()->subDays(2),
            'CreatedBy' => $user2->UserID,
            'AssignedTo' => $user1->UserID,
            'DepartmentID' => $dept1->DepartmentID
        ]);

        // Create comments
        Comment::create([
            'TaskID' => $task1->TaskID,
            'UserID' => $user2->UserID,
            'CommentText' => 'I have started working on this issue. Will update by tomorrow.',
            'DatePosted' => now()
        ]);

        Comment::create([
            'TaskID' => $task1->TaskID,
            'UserID' => $user1->UserID,
            'CommentText' => 'Thanks for the update. Let me know if you need any assistance.',
            'DatePosted' => now()->addMinutes(30)
        ]);

        Comment::create([
            'TaskID' => $task4->TaskID,
            'UserID' => $user1->UserID,
            'CommentText' => 'Great work! All changes approved.',
            'DatePosted' => now()
        ]);

        // Create reports
        $report1 = Report::create([
            'Title' => 'Monthly IT Incidents Report',
            'CreatedBy' => $user2->UserID,
            'DateGenerated' => now()
        ]);

        $report1->tasks()->sync([$task1->TaskID, $task4->TaskID]);

        $report2 = Report::create([
            'Title' => 'Department Workload Analysis',
            'CreatedBy' => $user1->UserID,
            'DateGenerated' => now()
        ]);

        $report2->tasks()->sync([$task1->TaskID, $task2->TaskID, $task3->TaskID]);

        // Create system parameters
        SystemParameter::create([
            'ParameterType' => 'max_task_priority',
            'ParameterValue' => 'critical'
        ]);

        SystemParameter::create([
            'ParameterType' => 'default_task_deadline_days',
            'ParameterValue' => '7'
        ]);

        SystemParameter::create([
            'ParameterType' => 'app_name',
            'ParameterValue' => 'Task Management System'
        ]);

        echo "Test data seeded successfully!\n";
    }
}
