<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id('TaskID');
            $table->string('Title');
            $table->text('Description')->nullable();
            $table->string('Priority')->default('medium');
            $table->string('Status')->default('pending');
            $table->dateTime('Deadline')->nullable();
            $table->foreignId('CreatedBy')
                ->constrained('users', 'UserID')
                ->onDelete('cascade');
            $table->foreignId('AssignedTo')
                ->constrained('users', 'UserID')
                ->onDelete('set null')
                ->nullable();
            $table->foreignId('DepartmentID')
                ->constrained('departments', 'DepartmentID')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
