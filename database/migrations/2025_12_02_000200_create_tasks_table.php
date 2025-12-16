<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // UNSIGNED BIGINT – match with users.id

            $table->string('title');
            $table->text('description')->nullable();

            $table->enum('priority', ['low', 'medium', 'high'])
                ->default('medium');

            $table->enum('status', ['pending', 'in_progress', 'completed'])
                ->default('pending');

            $table->date('due_date')->nullable();

            // Foreign keys
            $table->foreignId('department_id')
                ->constrained()          // references departments.id
                ->cascadeOnDelete();

            $table->foreignId('created_by')
                ->constrained('users')   // references users.id
                ->cascadeOnDelete();

            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')   // references users.id
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};