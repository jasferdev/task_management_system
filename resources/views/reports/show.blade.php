@extends('layouts.app')

@section('title', 'View Report - Task Management System')
@section('page-title', 'Report Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8 mb-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h3 class="text-3xl font-bold text-gray-800">{{ $report->Title }}</h3>
                <p class="text-gray-600 mt-1">Report ID: {{ $report->ReportID }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('reports.edit', $report) }}" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold">
                    Edit
                </a>
                <form action="{{ route('reports.destroy', $report) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg font-semibold">
                        Delete
                    </button>
                </form>
                <a href="{{ route('reports.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold">
                    Back
                </a>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                <p class="text-gray-600 text-sm">Created By</p>
                <p class="text-sm font-semibold">{{ $report->creator?->Name ?? 'Unknown' }}</p>
            </div>
            <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                <p class="text-gray-600 text-sm">Date Generated</p>
                <p class="text-sm font-semibold">{{ $report->DateGenerated ? $report->DateGenerated->format('M d, Y H:i') : 'N/A' }}</p>
            </div>
            <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                <p class="text-gray-600 text-sm">Tasks Included</p>
                <p class="text-2xl font-bold text-purple-600">{{ $report->tasks->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Tasks Section -->
    <div class="bg-white rounded-lg shadow-md p-8">
        <h4 class="text-2xl font-bold text-gray-800 mb-6">Tasks in Report ({{ $report->tasks->count() }})</h4>

        @if($report->tasks->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Task ID</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Title</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Priority</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Assigned To</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($report->tasks as $task)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-sm">{{ $task->TaskID }}</td>
                                <td class="px-4 py-3 text-sm font-semibold">{{ Str::limit($task->Title, 30) }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="badge {{ $task->Priority == 'critical' ? 'badge-danger' : ($task->Priority == 'high' ? 'badge-warning' : 'badge-success') }}">
                                        {{ ucfirst($task->Priority) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="badge {{ $task->Status == 'completed' ? 'badge-success' : 'badge-warning' }}">
                                        {{ ucfirst(str_replace('_', ' ', $task->Status)) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $task->assignee ? $task->assignee->Name : 'Unassigned' }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('tasks.show', $task) }}" class="text-blue-500 hover:text-blue-700 text-sm font-semibold">
                                        View
                                    </a>
                                    <form action="{{ route('reports.removeTask', [$report->ReportID, $task->TaskID]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Remove from report?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold ml-3">
                                            Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">No tasks included in this report.</p>
        @endif
    </div>
</div>
@endsection
