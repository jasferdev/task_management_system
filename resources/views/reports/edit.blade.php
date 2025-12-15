@extends('layouts.app')

@section('title', 'Edit Report - Task Management System')
@section('page-title', 'Edit Report')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Edit Report</h3>

        <form action="{{ route('reports.update', $report) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="Title" class="block text-sm font-semibold text-gray-800 mb-2">
                    Report Title <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="Title" 
                    name="Title" 
                    class="form-input @error('Title') border-red-500 @enderror"
                    placeholder="Enter report title"
                    value="{{ old('Title', $report->Title) }}"
                    required
                >
                @error('Title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-800 mb-3">
                    Select Tasks to Include
                </label>
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 max-h-80 overflow-y-auto">
                    @foreach($tasks as $task)
                        <div class="mb-3 flex items-start">
                            <input 
                                type="checkbox" 
                                id="task_{{ $task->TaskID }}" 
                                name="task_ids[]" 
                                value="{{ $task->TaskID }}"
                                class="mt-1 rounded"
                                {{ $report->tasks->pluck('TaskID')->contains($task->TaskID) || (is_array(old('task_ids')) && in_array($task->TaskID, old('task_ids'))) ? 'checked' : '' }}
                            >
                            <label for="task_{{ $task->TaskID }}" class="ml-3 flex-1 cursor-pointer">
                                <p class="font-semibold text-gray-800">{{ $task->Title }}</p>
                                <p class="text-sm text-gray-600">{{ Str::limit($task->Description, 60) }}</p>
                                <div class="flex space-x-2 mt-1">
                                    <span class="badge badge-info text-xs">{{ ucfirst($task->Priority) }}</span>
                                    <span class="badge {{ $task->Status == 'completed' ? 'badge-success' : 'badge-warning' }} text-xs">
                                        {{ ucfirst(str_replace('_', ' ', $task->Status)) }}
                                    </span>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('task_ids')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="btn-primary text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg flex-1">
                    Update Report
                </button>
                <a href="{{ route('reports.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-semibold flex-1 text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
