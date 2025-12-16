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
        Schema::create('report_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ReportID');
            $table->foreign('ReportID')
                ->references('ReportID')
                ->on('reports')
                ->onDelete('cascade');
            $table->unsignedBigInteger('TaskID');
            $table->foreign('TaskID')
                ->references('TaskID')
                ->on('tasks')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_tasks');
    }
};
