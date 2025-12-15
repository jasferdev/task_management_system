@extends('layouts.app')

@section('title', 'View Department - Task Management System')
@section('page-title', 'Department Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8 mb-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h3 class="text-3xl font-bold text-gray-800">{{ $department->DepartmentName }}</h3>
                <p class="text-gray-600 mt-1">Department ID: {{ $department->DepartmentID }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('departments.edit', $department) }}" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold">
                    Edit
                </a>
                <form action="{{ route('departments.destroy', $department) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg font-semibold">
                        Delete
                    </button>
                </form>
                <a href="{{ route('departments.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold">
                    Back to List
                </a>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-600 text-sm">Total Users</p>
                <p class="text-3xl font-bold text-blue-600">{{ $department->users->count() }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-600 text-sm">Total Tasks</p>
                <p class="text-3xl font-bold text-green-600">{{ $department->tasks->count() }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-600 text-sm">Created</p>
                <p class="text-lg font-semibold text-gray-800">{{ $department->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Users Section -->
    <div class="bg-white rounded-lg shadow-md p-8 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">Users in this Department</h4>
        @if($department->users->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold">User ID</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Name</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Email</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Role</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($department->users as $user)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm">{{ $user->UserID }}</td>
                                <td class="px-4 py-3 text-sm font-semibold">{{ $user->Name }}</td>
                                <td class="px-4 py-3 text-sm">{{ $user->Email }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="badge badge-info">{{ $user->Role }}</span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="badge {{ $user->Status == 'active' ? 'badge-success' : 'badge-danger' }}">{{ $user->Status }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">No users assigned to this department yet.</p>
        @endif
    </div>

    <!-- Tasks Section -->
    <div class="bg-white rounded-lg shadow-md p-8">
        <h4 class="text-xl font-bold text-gray-800 mb-4">Tasks in this Department</h4>
        @if($department->tasks->count() > 0)
            <div class="space-y-3">
                @foreach($department->tasks as $task)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h5 class="font-semibold text-gray-800">{{ $task->Title }}</h5>
                                <p class="text-sm text-gray-600">{{ Str::limit($task->Description, 100) }}</p>
                                <div class="flex space-x-2 mt-2">
                                    <span class="badge badge-info">{{ $task->Priority }}</span>
                                    <span class="badge {{ $task->Status == 'completed' ? 'badge-success' : 'badge-warning' }}">{{ $task->Status }}</span>
                                </div>
                            </div>
                            <a href="{{ route('tasks.show', $task) }}" class="text-blue-500 hover:text-blue-700">
                                View →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No tasks in this department yet.</p>
        @endif
    </div>
</div>
@endsection
