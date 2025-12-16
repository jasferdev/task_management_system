<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('report_tasks', function (Blueprint $table) {
            $table->id();

            // ReportID (FK → reports)
            $table->foreignId('report_id')
                  ->constrained('reports')
                  ->cascadeOnDelete();

            // TaskID (FK → tasks)
            $table->foreignId('task_id')
                  ->constrained('tasks')
                  ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_tasks');
    }
};
