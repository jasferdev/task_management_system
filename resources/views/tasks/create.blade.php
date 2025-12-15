@extends('layouts.app')

@section('title', 'Create Task - Task Management System')
@section('page-title', 'Create New Task')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Create New Task</h3>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="Title" class="block text-sm font-semibold text-gray-800 mb-2">
                    Task Title <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="Title" 
                    name="Title" 
                    class="form-input @error('Title') border-red-500 @enderror"
                    placeholder="Enter task title"
                    value="{{ old('Title') }}"
                    required
                >
                @error('Title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="Description" class="block text-sm font-semibold text-gray-800 mb-2">
                    Description
                </label>
                <textarea 
                    id="Description" 
                    name="Description" 
                    rows="5"
                    class="form-input @error('Description') border-red-500 @enderror"
                    placeholder="Enter task description"
                >{{ old('Description') }}</textarea>
                @error('Description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-3 gap-6 mb-6">
                <div>
                    <label for="Priority" class="block text-sm font-semibold text-gray-800 mb-2">
                        Priority <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="Priority" 
                        name="Priority" 
                        class="form-input @error('Priority') border-red-500 @enderror"
                        required
                    >
                        <option value="">Select priority</option>
                        <option value="low" {{ old('Priority') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('Priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('Priority') == 'high' ? 'selected' : '' }}>High</option>
                        <option value="critical" {{ old('Priority') == 'critical' ? 'selected' : '' }}>Critical</option>
                    </select>
                    @error('Priority')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="Status" class="block text-sm font-semibold text-gray-800 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="Status" 
                        name="Status" 
                        class="form-input @error('Status') border-red-500 @enderror"
                        required
                    >
                        <option value="">Select status</option>
                        <option value="pending" {{ old('Status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ old('Status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ old('Status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('Status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('Status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="Deadline" class="block text-sm font-semibold text-gray-800 mb-2">
                        Deadline
                    </label>
                    <input 
                        type="datetime-local" 
                        id="Deadline" 
                        name="Deadline" 
                        class="form-input @error('Deadline') border-red-500 @enderror"
                        value="{{ old('Deadline') }}"
                    >
                    @error('Deadline')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="DepartmentID" class="block text-sm font-semibold text-gray-800 mb-2">
                        Department <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="DepartmentID" 
                        name="DepartmentID" 
                        class="form-input @error('DepartmentID') border-red-500 @enderror"
                        required
                    >
                        <option value="">Select department</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->DepartmentID }}" {{ old('DepartmentID') == $dept->DepartmentID ? 'selected' : '' }}>
                                {{ $dept->DepartmentName }}
                            </option>
                        @endforeach
                    </select>
                    @error('DepartmentID')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="AssignedTo" class="block text-sm font-semibold text-gray-800 mb-2">
                        Assign To
                    </label>
                    <select 
                        id="AssignedTo" 
                        name="AssignedTo" 
                        class="form-input @error('AssignedTo') border-red-500 @enderror"
                    >
                        <option value="">Unassigned</option>
                        @foreach($users as $user)
                            <option value="{{ $user->UserID }}" {{ old('AssignedTo') == $user->UserID ? 'selected' : '' }}>
                                {{ $user->Name }}
                            </option>
                        @endforeach
                    </select>
                    @error('AssignedTo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="btn-primary text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg flex-1">
                    Create Task
                </button>
                <a href="{{ route('tasks.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-semibold flex-1 text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
