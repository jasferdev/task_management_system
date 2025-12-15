<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get departments
        $itDept = Department::where('DepartmentName', 'IT')->first();
        $hrDept = Department::where('DepartmentName', 'Human Resources')->first();
        $financeDept = Department::where('DepartmentName', 'Finance')->first();
        $salesDept = Department::where('DepartmentName', 'Sales')->first();

        $users = [
            [
                'Name' => 'Admin User',
                'Email' => 'admin@example.com',
                'Role' => 'admin',
                'Status' => 'active',
                'DepartmentID' => $itDept->DepartmentID ?? 1,
                'password' => Hash::make('password123'),
            ],
            [
                'Name' => 'John Manager',
                'Email' => 'john@example.com',
                'Role' => 'manager',
                'Status' => 'active',
                'DepartmentID' => $itDept->DepartmentID ?? 1,
                'password' => Hash::make('password123'),
            ],
            [
                'Name' => 'Jane Smith',
                'Email' => 'jane@example.com',
                'Role' => 'user',
                'Status' => 'active',
                'DepartmentID' => $hrDept->DepartmentID ?? 2,
                'password' => Hash::make('password123'),
            ],
            [
                'Name' => 'Bob Johnson',
                'Email' => 'bob@example.com',
                'Role' => 'user',
                'Status' => 'active',
                'DepartmentID' => $financeDept->DepartmentID ?? 3,
                'password' => Hash::make('password123'),
            ],
            [
                'Name' => 'Alice Williams',
                'Email' => 'alice@example.com',
                'Role' => 'user',
                'Status' => 'active',
                'DepartmentID' => $salesDept->DepartmentID ?? 4,
                'password' => Hash::make('password123'),
            ],
            [
                'Name' => 'Charlie Brown',
                'Email' => 'charlie@example.com',
                'Role' => 'user',
                'Status' => 'active',
                'DepartmentID' => $itDept->DepartmentID ?? 1,
                'password' => Hash::make('password123'),
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['Email' => $user['Email']],
                $user
            );
        }
    }
}
