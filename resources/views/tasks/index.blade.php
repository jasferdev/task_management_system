@extends('layouts.app')

@section('title', 'Tasks - Task Management System')
@section('page-title', 'Tasks')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h3 class="text-2xl font-bold text-gray-800">✓ All Tasks</h3>
    <a href="{{ route('tasks.create') }}" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
        ➕ Create New Task
    </a>
</div>

<!-- Filter Section -->
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <form method="GET" class="flex space-x-4">
        <select name="status" class="form-input w-40">
            <option value="">All Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>⚡ In Progress</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>✅ Completed</option>
            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
        </select>
        <select name="priority" class="form-input w-40">
            <option value="">All Priority</option>
            <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>🔵 Low</option>
            <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>🟡 Medium</option>
            <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>🟠 High</option>
            <option value="critical" {{ request('priority') == 'critical' ? 'selected' : '' }}>🔴 Critical</option>
        </select>
        <button type="submit" class="btn-primary text-white px-6 py-2 rounded-lg font-semibold">
            🔍 Filter
        </button>
    </form>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gradient-to-r from-orange-500 to-orange-600 text-white border-b">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold">Task</th>
                <th class="px-6 py-4 text-left text-sm font-semibold">🎯 Priority</th>
                <th class="px-6 py-4 text-left text-sm font-semibold">📊 Status</th>
                <th class="px-6 py-4 text-left text-sm font-semibold">👤 Assigned</th>
                <th class="px-6 py-4 text-left text-sm font-semibold">📅 Deadline</th>
                <th class="px-6 py-4 text-center text-sm font-semibold">⚙️ Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)
                <tr class="border-b hover:bg-orange-50 transition duration-200">
                    <td class="px-6 py-4 text-sm">
                        <div class="flex items-center gap-3">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-orange-100 text-orange-600 font-bold">
                                {{ substr($task->Title, 0, 1) }}
                            </span>
                            <div>
                                <p class="font-semibold text-gray-800">{{ Str::limit($task->Title, 30) }}</p>
                                <p class="text-xs text-gray-500">ID: {{ $task->TaskID }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @switch($task->Priority)
                            @case('critical')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold" style="background-color: #fee2e2; color: #7f1d1d;">
                                    🔴 Critical
                                </span>
                            @break
                            @case('high')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-orange-100 text-orange-800">
                                    🟠 High
                                </span>
                            @break
                            @case('medium')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold" style="background-color: #fef3c7; color: #92400e;">
                                    🟡 Medium
                                </span>
                            @break
                            @case('low')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                    🔵 Low
                                </span>
                            @break
                        @endswitch
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @switch($task->Status)
                            @case('completed')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                    ✅ Completed
                                </span>
                            @break
                            @case('in_progress')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold" style="background-color: #fef3c7; color: #92400e;">
                                    ⚡ In Progress
                                </span>
                            @break
                            @case('pending')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold" style="background-color: #dbeafe; color: #1e40af;">
                                    ⏳ Pending
                                </span>
                            @break
                            @case('cancelled')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold" style="background-color: #fee2e2; color: #7f1d1d;">
                                    ❌ Cancelled
                                </span>
                            @break
                        @endswitch
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-purple-100 text-purple-800">
                            {{ $task->assignee ? $task->assignee->Name : '👤 Unassigned' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $task->Deadline ? $task->Deadline->format('M d, Y') : '📭 N/A' }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('tasks.show', $task) }}" class="inline-flex items-center px-3 py-1 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition font-semibold text-xs">
                                👁️ View
                            </a>
                            <a href="{{ route('tasks.edit', $task) }}" class="inline-flex items-center px-3 py-1 rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition font-semibold text-xs">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition font-semibold text-xs">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        📭 No tasks found. <a href="{{ route('tasks.create') }}" class="text-orange-500 hover:underline font-semibold">Create one</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $tasks->links() }}
</div>
@endsection
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('tasks.show', $task) }}" class="text-blue-500 hover:text-blue-700 text-sm font-semibold">
                            View
                        </a>
                        <a href="{{ route('tasks.edit', $task) }}" class="text-yellow-500 hover:text-yellow-700 text-sm font-semibold ml-3">
                            Edit
                        </a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold ml-3">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                        No tasks found. <a href="{{ route('tasks.create') }}" class="text-blue-500 hover:underline">Create one</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $tasks->links() }}
</div>
@endsection
