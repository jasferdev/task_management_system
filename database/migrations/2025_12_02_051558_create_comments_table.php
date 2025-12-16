<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // CommentID (PK)

            // TaskID (FK → tasks)
            $table->foreignId('task_id')
                  ->constrained('tasks')
                  ->cascadeOnDelete();

            // UserID (FK → users)
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->text('comment_text');           // CommentText
            $table->timestamp('date_posted')->nullable(); // DatePosted

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
