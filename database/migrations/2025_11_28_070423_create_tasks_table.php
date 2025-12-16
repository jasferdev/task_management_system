<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id('TaskID'); // Primary Key
            $table->string('Title');
            $table->text('Description')->nullable();
            $table->enum('Priority', ['Low', 'Medium', 'High'])->default('Medium');
            $table->enum('Status', ['Pending', 'In Progress', 'Completed'])->default('Pending');
            $table->date('Deadline')->nullable();
            $table->string('CreatedBy');
            $table->string('AssignedTo')->nullable();
            $table->unsignedBigInteger('DepartmentID');
            $table->timestamps();

            // Foreign Key
            $table->foreign('DepartmentID')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('tasks');
    }
};


