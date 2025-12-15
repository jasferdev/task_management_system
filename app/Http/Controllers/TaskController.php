<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of tasks.
     */
    public function index()
    {
        $tasks = Task::with('creator', 'assignee', 'department', 'comments')->paginate(15);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     */
    public function create()
    {
        $departments = Department::all();
        $users = User::all();
        return view('tasks.create', compact('departments', 'users'));
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Title' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Priority' => 'required|string|in:low,medium,high,critical',
            'Status' => 'required|string|in:pending,in_progress,completed,cancelled',
            'Deadline' => 'nullable|date',
            'AssignedTo' => 'nullable|exists:users,UserID',
            'DepartmentID' => 'required|exists:departments,DepartmentID',
        ]);

        $validated['CreatedBy'] = auth()->id() ?? 1; // Default to user 1 if not authenticated
        $task = Task::create($validated);

        return redirect()->route('tasks.show', $task->TaskID)
                       ->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified task.
     */
    public function show(Task $task)
    {
        $task->load('creator', 'assignee', 'department', 'comments', 'reports');
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit(Task $task)
    {
        $departments = Department::all();
        $users = User::all();
        return view('tasks.edit', compact('task', 'departments', 'users'));
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'Title' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Priority' => 'required|string|in:low,medium,high,critical',
            'Status' => 'required|string|in:pending,in_progress,completed,cancelled',
            'Deadline' => 'nullable|date',
            'AssignedTo' => 'nullable|exists:users,UserID',
            'DepartmentID' => 'required|exists:departments,DepartmentID',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.show', $task->TaskID)
                       ->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
                       ->with('success', 'Task deleted successfully!');
    }

    /**
     * Get tasks by status.
     */
    public function getByStatus($status)
    {
        $tasks = Task::where('Status', $status)->with('creator', 'assignee')->paginate(15);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Get tasks assigned to a specific user.
     */
    public function getAssignedToUser($userId)
    {
        $tasks = Task::where('AssignedTo', $userId)->with('creator', 'department', 'comments')->paginate(15);
        return view('tasks.index', compact('tasks'));
    }
}
