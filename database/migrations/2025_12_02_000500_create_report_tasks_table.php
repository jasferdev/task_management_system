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

            $table->foreignId('report_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('task_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();

            // Optional: prevent duplicate report-task pairs
            $table->unique(['report_id', 'task_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_tasks');
    }
};



