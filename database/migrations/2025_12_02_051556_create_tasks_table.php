<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // TaskID (PK)

            $table->string('title');           // Title
            $table->text('description')->nullable(); // Description
            $table->string('priority')->nullable();  // Priority
            $table->string('status')->default('pending'); // Status
            $table->date('deadline')->nullable();   // Deadline

            // CreatedBy (FK → users)
            $table->foreignId('created_by')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // AssignedTo (FK → users)
            $table->foreignId('assigned_to')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            // DepartmentID (FK → departments)
            $table->foreignId('department_id')
                  ->nullable()
                  ->constrained('departments')
                  ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};