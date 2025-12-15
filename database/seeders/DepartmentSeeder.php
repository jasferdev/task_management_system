<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['DepartmentName' => 'IT'],
            ['DepartmentName' => 'Human Resources'],
            ['DepartmentName' => 'Finance'],
            ['DepartmentName' => 'Sales'],
            ['DepartmentName' => 'Marketing'],
            ['DepartmentName' => 'Operations'],
        ];

        foreach ($departments as $department) {
            Department::firstOrCreate(
                ['DepartmentName' => $department['DepartmentName']],
                $department
            );
        }
    }
}
