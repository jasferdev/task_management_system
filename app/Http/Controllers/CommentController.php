<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of comments.
     */
    public function index()
    {
        $comments = Comment::with('task', 'user')->paginate(15);
        return view('comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new comment.
     */
    public function create()
    {
        $tasks = Task::all();
        return view('comments.create', compact('tasks'));
    }

    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'TaskID' => 'required|exists:tasks,TaskID',
            'UserID' => 'required|exists:users,UserID',
            'CommentText' => 'required|string',
        ]);

        $validated['DatePosted'] = now();
        $comment = Comment::create($validated);

        return redirect()->route('tasks.show', $validated['TaskID'])
                       ->with('success', 'Comment posted successfully!');
    }

    /**
     * Display the specified comment.
     */
    public function show(Comment $comment)
    {
        $comment->load('task', 'user');
        return view('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified comment.
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'CommentText' => 'required|string',
        ]);

        $comment->update($validated);

        return redirect()->route('comments.show', $comment->CommentID)
                       ->with('success', 'Comment updated successfully!');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Comment $comment)
    {
        $taskId = $comment->TaskID;
        $comment->delete();

        return redirect()->route('tasks.show', $taskId)
                       ->with('success', 'Comment deleted successfully!');
    }

    /**
     * Get all comments for a specific task.
     */
    public function getTaskComments($taskId)
    {
        $comments = Comment::where('TaskID', $taskId)->with('user')->paginate(10);
        return view('comments.index', compact('comments'));
    }
}
