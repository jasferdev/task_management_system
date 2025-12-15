<?php

namespace Database\Seeders;

use App\Models\SystemParameter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parameters = [
            [
                'ParameterType' => 'max_task_deadline_days',
                'ParameterValue' => '90',
            ],
            [
                'ParameterType' => 'default_task_priority',
                'ParameterValue' => 'medium',
            ],
            [
                'ParameterType' => 'system_admin_email',
                'ParameterValue' => 'admin@example.com',
            ],
            [
                'ParameterType' => 'notification_enabled',
                'ParameterValue' => 'true',
            ],
            [
                'ParameterType' => 'task_auto_archive_days',
                'ParameterValue' => '30',
            ],
            [
                'ParameterType' => 'max_users_per_department',
                'ParameterValue' => '50',
            ],
        ];

        foreach ($parameters as $parameter) {
            SystemParameter::firstOrCreate(
                ['ParameterType' => $parameter['ParameterType']],
                $parameter
            );
        }
    }
}
