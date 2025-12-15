@extends('layouts.app')

@section('title', 'Dashboard - Task Management System')
@section('page-title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Departments Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Departments</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $departmentCount }}</p>
                </div>
                <div class="text-blue-500 text-4xl opacity-20">📁</div>
            </div>
            <a href="{{ route('departments.index') }}" class="text-blue-500 text-sm mt-3 block hover:underline">
                View all →
            </a>
        </div>

        <!-- Users Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Users</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $userCount }}</p>
                </div>
                <div class="text-green-500 text-4xl opacity-20">👥</div>
            </div>
            <a href="{{ route('users.index') }}" class="text-green-500 text-sm mt-3 block hover:underline">
                View all →
            </a>
        </div>

        <!-- Tasks Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-orange-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Tasks</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $taskCount }}</p>
                </div>
                <div class="text-orange-500 text-4xl opacity-20">✓</div>
            </div>
            <a href="{{ route('tasks.index') }}" class="text-orange-500 text-sm mt-3 block hover:underline">
                View all →
            </a>
        </div>

        <!-- Reports Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Reports</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $reportCount }}</p>
                </div>
                <div class="text-purple-500 text-4xl opacity-20">📊</div>
            </div>
            <a href="{{ route('reports.index') }}" class="text-purple-500 text-sm mt-3 block hover:underline">
                View all →
            </a>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Recent Tasks -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Recent Tasks</h3>
            @if($recentTasks->count() > 0)
                <div class="space-y-3">
                    @foreach($recentTasks as $task)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded border-l-4 border-orange-500">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $task->Title }}</p>
                                <p class="text-xs text-gray-600">{{ $task->department->DepartmentName ?? 'No Department' }}</p>
                            </div>
                            <a href="{{ route('tasks.show', $task) }}" class="text-orange-500 text-sm hover:underline">
                                View →
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-4">No tasks yet</p>
            @endif
        </div>

        <!-- Task Status Summary -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Task Status</h3>
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">Pending</span>
                    <span class="badge" style="background-color: #fef3c7; color: #92400e;">{{ $pendingCount }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">In Progress</span>
                    <span class="badge" style="background-color: #bfdbfe; color: #1e40af;">{{ $inProgressCount }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">Completed</span>
                    <span class="badge badge-success">{{ $completedCount }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">Cancelled</span>
                    <span class="badge" style="background-color: #fee2e2; color: #7f1d1d;">{{ $cancelledCount }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Create Buttons -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h3>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('departments.create') }}" class="btn-primary text-white px-4 py-2 rounded-lg font-semibold hover:opacity-90">
                + New Department
            </a>
            <a href="{{ route('users.create') }}" class="btn-primary text-white px-4 py-2 rounded-lg font-semibold hover:opacity-90">
                + New User
            </a>
            <a href="{{ route('tasks.create') }}" class="btn-primary text-white px-4 py-2 rounded-lg font-semibold hover:opacity-90">
                + New Task
            </a>
            <a href="{{ route('reports.create') }}" class="btn-primary text-white px-4 py-2 rounded-lg font-semibold hover:opacity-90">
                + New Report
            </a>
        </div>
    </div>
</div>

<style>
    .badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
    }
    .badge-success {
        background-color: #d1fae5;
        color: #065f46;
    }
</style>
@endsection

