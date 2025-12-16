<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EnhancedUserSeeder extends Seeder
{
    /**
     * Run the database seeds with enhanced user data.
     */
    public function run(): void
    {
        // Get or create departments
        $departments = [
            'IT' => Department::where('DepartmentName', 'LIKE', '%IT%')->first(),
            'HR' => Department::where('DepartmentName', 'LIKE', '%Human Resources%')->first(),
            'Finance' => Department::where('DepartmentName', 'LIKE', '%Finance%')->first(),
            'Sales' => Department::where('DepartmentName', 'LIKE', '%Sales%')->first(),
            'Marketing' => Department::where('DepartmentName', 'LIKE', '%Marketing%')->first(),
        ];

        $users = [
            // Admins
            [
                'Name' => 'System Administrator',
                'Email' => 'admin@taskmgmt.com',
                'Role' => 'admin',
                'Status' => 'active',
                'DepartmentID' => $departments['IT']->DepartmentID ?? 1,
                'password' => Hash::make('admin123'),
            ],
            [
                'Name' => 'Super Admin',
                'Email' => 'superadmin@taskmgmt.com',
                'Role' => 'admin',
                'Status' => 'active',
                'DepartmentID' => $departments['IT']->DepartmentID ?? 1,
                'password' => Hash::make('admin123'),
            ],
            // Managers
            [
                'Name' => 'IT Manager',
                'Email' => 'it.manager@taskmgmt.com',
                'Role' => 'manager',
                'Status' => 'active',
                'DepartmentID' => $departments['IT']->DepartmentID ?? 1,
                'password' => Hash::make('manager123'),
            ],
            [
                'Name' => 'HR Manager',
                'Email' => 'hr.manager@taskmgmt.com',
                'Role' => 'manager',
                'Status' => 'active',
                'DepartmentID' => $departments['HR']->DepartmentID ?? 2,
                'password' => Hash::make('manager123'),
            ],
            [
                'Name' => 'Sales Manager',
                'Email' => 'sales.manager@taskmgmt.com',
                'Role' => 'manager',
                'Status' => 'active',
                'DepartmentID' => $departments['Sales']->DepartmentID ?? 4,
                'password' => Hash::make('manager123'),
            ],
            // Regular Users
            [
                'Name' => 'Alice Johnson',
                'Email' => 'alice@taskmgmt.com',
                'Role' => 'user',
                'Status' => 'active',
                'DepartmentID' => $departments['IT']->DepartmentID ?? 1,
                'password' => Hash::make('user123'),
            ],
            [
                'Name' => 'Bob Smith',
                'Email' => 'bob@taskmgmt.com',
                'Role' => 'user',
                'Status' => 'active',
                'DepartmentID' => $departments['IT']->DepartmentID ?? 1,
                'password' => Hash::make('user123'),
            ],
            [
                'Name' => 'Carol Williams',
                'Email' => 'carol@taskmgmt.com',
                'Role' => 'user',
                'Status' => 'active',
                'DepartmentID' => $departments['HR']->DepartmentID ?? 2,
                'password' => Hash::make('user123'),
            ],
            [
                'Name' => 'David Brown',
                'Email' => 'david@taskmgmt.com',
                'Role' => 'user',
                'Status' => 'active',
                'DepartmentID' => $departments['Finance']->DepartmentID ?? 3,
                'password' => Hash::make('user123'),
            ],
            [
                'Name' => 'Emma Davis',
                'Email' => 'emma@taskmgmt.com',
                'Role' => 'user',
                'Status' => 'active',
                'DepartmentID' => $departments['Sales']->DepartmentID ?? 4,
                'password' => Hash::make('user123'),
            ],
            [
                'Name' => 'Frank Miller',
                'Email' => 'frank@taskmgmt.com',
                'Role' => 'user',
                'Status' => 'active',
                'DepartmentID' => $departments['Marketing']->DepartmentID ?? 5,
                'password' => Hash::make('user123'),
            ],
            [
                'Name' => 'Grace Lee',
                'Email' => 'grace@taskmgmt.com',
                'Role' => 'user',
                'Status' => 'inactive',
                'DepartmentID' => $departments['IT']->DepartmentID ?? 1,
                'password' => Hash::make('user123'),
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
