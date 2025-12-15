@extends('layouts.app')

@section('title', 'View Comment - Task Management System')
@section('page-title', 'Comment Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h3 class="text-2xl font-bold text-gray-800">Comment by {{ $comment->user->Name }}</h3>
                <p class="text-gray-600 mt-1">on "<a href="{{ route('tasks.show', $comment->task) }}" class="text-blue-500 hover:underline">{{ $comment->task->Title }}</a>"</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('comments.edit', $comment) }}" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold">
                    Edit
                </a>
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg font-semibold">
                        Delete
                    </button>
                </form>
                <a href="{{ route('comments.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold">
                    Back
                </a>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                <p class="text-gray-600 text-sm">Comment ID</p>
                <p class="text-xl font-bold text-gray-800">{{ $comment->CommentID }}</p>
            </div>
            <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                <p class="text-gray-600 text-sm">Posted By</p>
                <p class="text-sm font-semibold">{{ $comment->user->Name }}</p>
            </div>
            <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                <p class="text-gray-600 text-sm">Posted At</p>
                <p class="text-sm font-semibold">{{ $comment->DatePosted->format('M d, Y H:i') }}</p>
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
            <h4 class="text-sm font-semibold text-gray-700 mb-3">Comment Text</h4>
            <p class="text-gray-800 leading-relaxed">{{ $comment->CommentText }}</p>
        </div>

        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <p class="text-sm text-gray-600">Related Task:</p>
            <a href="{{ route('tasks.show', $comment->task) }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                → {{ $comment->task->Title }}
            </a>
        </div>
    </div>
</div>
@endsection
