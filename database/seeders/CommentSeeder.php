<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::where('Email', 'admin@example.com')->first();
        $johnUser = User::where('Email', 'john@example.com')->first();
        $janeUser = User::where('Email', 'jane@example.com')->first();
        $bobUser = User::where('Email', 'bob@example.com')->first();

        $setupTask = Task::where('Title', 'Setup Development Environment')->first();
        $bugTask = Task::where('Title', 'Fix Database Connection Bug')->first();
        $docTask = Task::where('Title', 'Create User Documentation')->first();

        $comments = [
            [
                'TaskID' => $setupTask->TaskID ?? 1,
                'UserID' => $johnUser->UserID ?? 2,
                'CommentText' => 'I have started setting up the development environment. Will have the initial setup done by tomorrow.',
                'DatePosted' => now()->subHours(5),
            ],
            [
                'TaskID' => $setupTask->TaskID ?? 1,
                'UserID' => $adminUser->UserID ?? 1,
                'CommentText' => 'Great! Please make sure to include all dependencies in the documentation.',
                'DatePosted' => now()->subHours(3),
            ],
            [
                'TaskID' => $bugTask->TaskID ?? 2,
                'UserID' => $bobUser->UserID ?? 4,
                'CommentText' => 'I found the issue! The connection pool size was too small. Fixing it now.',
                'DatePosted' => now()->subHours(2),
            ],
            [
                'TaskID' => $bugTask->TaskID ?? 2,
                'UserID' => $johnUser->UserID ?? 2,
                'CommentText' => 'Excellent work, Bob! Please test it thoroughly before merging.',
                'DatePosted' => now()->subHour(),
            ],
            [
                'TaskID' => $docTask->TaskID ?? 3,
                'UserID' => $janeUser->UserID ?? 3,
                'CommentText' => 'Started working on the user documentation. Should be ready by end of week.',
                'DatePosted' => now()->subHours(4),
            ],
        ];

        foreach ($comments as $comment) {
            Comment::firstOrCreate(
                [
                    'TaskID' => $comment['TaskID'],
                    'UserID' => $comment['UserID'],
                    'CommentText' => $comment['CommentText'],
                ],
                $comment
            );
        }
    }
}
