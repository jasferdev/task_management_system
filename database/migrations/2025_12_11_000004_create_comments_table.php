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
        Schema::create('comments', function (Blueprint $table) {
            $table->id('CommentID');
            $table->foreignId('TaskID')
                ->constrained('tasks', 'TaskID')
                ->onDelete('cascade');
            $table->foreignId('UserID')
                ->constrained('users', 'UserID')
                ->onDelete('cascade');
            $table->text('CommentText');
            $table->timestamp('DatePosted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
