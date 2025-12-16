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
            $table->unsignedBigInteger('CreatedBy');
            $table->foreign('CreatedBy')
                ->references('UserID')
                ->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('AssignedTo')->nullable();
            $table->foreign('AssignedTo')
                ->references('UserID')
                ->on('users')
                ->onDelete('set null');
            $table->unsignedBigInteger('DepartmentID');
            $table->foreign('DepartmentID')
                ->references('DepartmentID')
                ->on('departments')
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
