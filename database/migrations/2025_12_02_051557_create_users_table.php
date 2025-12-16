<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // DepartmentID (FK)
            $table->foreignId('department_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('departments')
                  ->nullOnDelete();

            // Role
            $table->string('role')->default('employee')->after('email');

            // Status (active / inactive)
            $table->string('status')->default('active')->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropColumn(['department_id', 'role', 'status']);
        });
    }
};
