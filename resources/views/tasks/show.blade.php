@extends('layouts.app')

@section('title', 'View Task - Task Management System')
@section('page-title', 'Task Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8 mb-6">
        <div class="flex justify-between items-start mb-6">
            <div class="flex-1">
                <h3 class="text-3xl font-bold text-gray-800">{{ $task->Title }}</h3>
                <p class="text-gray-600 mt-2">{{ $task->Description }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('tasks.edit', $task) }}" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold">
                    Edit
                </a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg font-semibold">
                        Delete
                    </button>
                </form>
                <a href="{{ route('tasks.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold">
                    Back
                </a>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                <p class="text-gray-600 text-sm">Task ID</p>
                <p class="text-lg font-bold text-gray-800">{{ $task->TaskID }}</p>
            </div>
            <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                <p class="text-gray-600 text-sm">Priority</p>
                <p class="badge" style="display: inline-block;">
                    @switch($task->Priority)
                        @case('critical')
                            <span class="badge badge-danger">Critical</span>
                        @break
                        @case('high')
                            <span class="badge" style="background-color: #fca5a5; color: #7f1d1d;">High</span>
                        @break
                        @case('medium')
                            <span class="badge badge-warning">Medium</span>
                        @break
                        @case('low')
                            <span class="badge badge-success">Low</span>
                        @break
                    @endswitch
                </p>
            </div>
            <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                <p class="text-gray-600 text-sm">Status</p>
                <p class="badge" style="display: inline-block;">
                    <span class="badge {{ $task->Status == 'completed' ? 'badge-success' : ($task->Status == 'in_progress' ? 'badge-warning' : 'badge-info') }}">
                        {{ ucfirst(str_replace('_', ' ', $task->Status)) }}
                    </span>
                </p>
            </div>
            <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                <p class="text-gray-600 text-sm">Department</p>
                <p class="text-lg font-bold text-gray-800">{{ $task->department->DepartmentName }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-600 text-sm">Created By</p>
                <p class="text-sm font-semibold">{{ $task->creator->Name }}</p>
                <p class="text-xs text-gray-500">{{ $task->created_at->format('M d, Y H:i') }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-600 text-sm">Assigned To</p>
                <p class="text-sm font-semibold">{{ $task->assignee ? $task->assignee->Name : 'Unassigned' }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-600 text-sm">Deadline</p>
                <p class="text-sm font-semibold">{{ $task->Deadline ? $task->Deadline->format('M d, Y H:i') : 'No deadline' }}</p>
            </div>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="bg-white rounded-lg shadow-md p-8 mb-6">
        <h4 class="text-2xl font-bold text-gray-800 mb-6">Comments ({{ $task->comments->count() }})</h4>

        @auth
        <div class="mb-6 bg-gray-50 p-4 rounded-lg">
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="TaskID" value="{{ $task->TaskID }}">
                <input type="hidden" name="UserID" value="{{ Auth::id() }}">
                
                <label class="block text-sm font-semibold text-gray-800 mb-2">Add a Comment</label>
                <textarea 
                    name="CommentText" 
                    rows="3"
                    class="form-input @error('CommentText') border-red-500 @enderror"
                    placeholder="Write your comment here..."
                    required
                ></textarea>
                <button type="submit" class="mt-3 btn-primary text-white px-6 py-2 rounded-lg font-semibold">
                    Post Comment
                </button>
            </form>
        </div>
        @endauth

        @if($task->comments->count() > 0)
            <div class="space-y-4">
                @foreach($task->comments as $comment)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-start mb-2">
                            <h5 class="font-semibold text-gray-800">{{ $comment->user->Name }}</h5>
                            <span class="text-xs text-gray-500">{{ $comment->DatePosted->format('M d, Y H:i') }}</span>
                        </div>
                        <p class="text-gray-700">{{ $comment->CommentText }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No comments yet. Be the first to comment!</p>
        @endif
    </div>

    <!-- Related Tasks Section -->
    @if($task->reports->count() > 0)
    <div class="bg-white rounded-lg shadow-md p-8">
        <h4 class="text-xl font-bold text-gray-800 mb-4">Included in Reports</h4>
        <div class="space-y-2">
            @foreach($task->reports as $report)
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                    <span class="font-semibold text-gray-800">{{ $report->Title }}</span>
                    <a href="{{ route('reports.show', $report) }}" class="text-blue-500 hover:text-blue-700">
                        View Report →
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
