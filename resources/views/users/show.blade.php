@extends('layouts.app')

@section('title', 'View User - Task Management System')
@section('page-title', 'User Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8 mb-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h3 class="text-3xl font-bold text-gray-800">{{ $user->Name }}</h3>
                <p class="text-gray-600 mt-1">{{ $user->Email }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('users.edit', $user) }}" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold">
                    Edit
                </a>
                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg font-semibold">
                        Delete
                    </button>
                </form>
                <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold">
                    Back to List
                </a>
            </div>
        </div>

        <div class="grid grid-cols-4 gap-4 mb-6">
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-600 text-sm">User ID</p>
                <p class="text-xl font-bold text-gray-800">{{ $user->UserID }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-600 text-sm">Role</p>
                <p class="badge badge-info">{{ ucfirst($user->Role) }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-600 text-sm">Status</p>
                <p class="badge {{ $user->Status == 'active' ? 'badge-success' : 'badge-danger' }}">{{ ucfirst($user->Status) }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-600 text-sm">Department</p>
                <p class="text-sm font-semibold">{{ $user->department->DepartmentName ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                <p class="text-gray-600 text-sm">Created Tasks</p>
                <p class="text-3xl font-bold text-blue-600">{{ $user->createdTasks->count() }}</p>
            </div>
            <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                <p class="text-gray-600 text-sm">Assigned Tasks</p>
                <p class="text-3xl font-bold text-green-600">{{ $user->assignedTasks->count() }}</p>
            </div>
            <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                <p class="text-gray-600 text-sm">Comments Made</p>
                <p class="text-3xl font-bold text-purple-600">{{ $user->comments->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Created Tasks Section -->
    <div class="bg-white rounded-lg shadow-md p-8 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">Tasks Created by {{ $user->Name }}</h4>
        @if($user->createdTasks->count() > 0)
            <div class="space-y-3">
                @foreach($user->createdTasks->take(5) as $task)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h5 class="font-semibold text-gray-800">{{ $task->Title }}</h5>
                                <p class="text-sm text-gray-600">{{ Str::limit($task->Description, 80) }}</p>
                                <div class="flex space-x-2 mt-2">
                                    <span class="badge badge-info">{{ ucfirst($task->Priority) }}</span>
                                    <span class="badge {{ $task->Status == 'completed' ? 'badge-success' : 'badge-warning' }}">{{ ucfirst($task->Status) }}</span>
                                </div>
                            </div>
                            <a href="{{ route('tasks.show', $task) }}" class="text-blue-500 hover:text-blue-700">
                                View →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($user->createdTasks->count() > 5)
                <a href="{{ route('tasks.index') }}?creator={{ $user->UserID }}" class="text-blue-500 hover:text-blue-700 mt-4 inline-block">
                    View all {{ $user->createdTasks->count() }} tasks →
                </a>
            @endif
        @else
            <p class="text-gray-500">No tasks created yet.</p>
        @endif
    </div>

    <!-- Assigned Tasks Section -->
    <div class="bg-white rounded-lg shadow-md p-8">
        <h4 class="text-xl font-bold text-gray-800 mb-4">Tasks Assigned to {{ $user->Name }}</h4>
        @if($user->assignedTasks->count() > 0)
            <div class="space-y-3">
                @foreach($user->assignedTasks->take(5) as $task)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h5 class="font-semibold text-gray-800">{{ $task->Title }}</h5>
                                <p class="text-sm text-gray-600">{{ Str::limit($task->Description, 80) }}</p>
                                <div class="flex space-x-2 mt-2">
                                    <span class="badge badge-info">{{ ucfirst($task->Priority) }}</span>
                                    <span class="badge {{ $task->Status == 'completed' ? 'badge-success' : 'badge-warning' }}">{{ ucfirst($task->Status) }}</span>
                                </div>
                            </div>
                            <a href="{{ route('tasks.show', $task) }}" class="text-blue-500 hover:text-blue-700">
                                View →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($user->assignedTasks->count() > 5)
                <a href="{{ route('tasks.index') }}?assignee={{ $user->UserID }}" class="text-blue-500 hover:text-blue-700 mt-4 inline-block">
                    View all {{ $user->assignedTasks->count() }} tasks →
                </a>
            @endif
        @else
            <p class="text-gray-500">No tasks assigned yet.</p>
        @endif
    </div>
</div>
@endsection
