@extends('layouts.app')

@section('title', 'Create Comment - Task Management System')
@section('page-title', 'Add Comment')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Add Comment to Task</h3>

        <form action="{{ route('comments.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="TaskID" class="block text-sm font-semibold text-gray-800 mb-2">
                    Task <span class="text-red-500">*</span>
                </label>
                <select 
                    id="TaskID" 
                    name="TaskID" 
                    class="form-input @error('TaskID') border-red-500 @enderror"
                    required
                >
                    <option value="">Select a task</option>
                    @foreach($tasks as $task)
                        <option value="{{ $task->TaskID }}" {{ old('TaskID') == $task->TaskID ? 'selected' : '' }}>
                            {{ $task->Title }}
                        </option>
                    @endforeach
                </select>
                @error('TaskID')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="CommentText" class="block text-sm font-semibold text-gray-800 mb-2">
                    Comment <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="CommentText" 
                    name="CommentText" 
                    rows="6"
                    class="form-input @error('CommentText') border-red-500 @enderror"
                    placeholder="Write your comment..."
                    required
                >{{ old('CommentText') }}</textarea>
                @error('CommentText')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="btn-primary text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg flex-1">
                    Post Comment
                </button>
                <a href="{{ route('comments.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-semibold flex-1 text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
