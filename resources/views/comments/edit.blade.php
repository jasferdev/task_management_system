@extends('layouts.app')

@section('title', 'Edit Comment - Task Management System')
@section('page-title', 'Edit Comment')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Edit Comment</h3>

        <form action="{{ route('comments.update', $comment) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <p class="block text-sm font-semibold text-gray-800 mb-2">
                    Task: <span class="text-blue-600">{{ $comment->task->Title }}</span>
                </p>
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
                >{{ old('CommentText', $comment->CommentText) }}</textarea>
                @error('CommentText')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="btn-primary text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg flex-1">
                    Update Comment
                </button>
                <a href="{{ route('comments.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-semibold flex-1 text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
