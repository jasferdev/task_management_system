@extends('layouts.app')

@section('title', 'Comments - Task Management System')
@section('page-title', 'All Comments')

@section('content')
<div class="mb-6">
    <h3 class="text-2xl font-bold text-gray-800">💬 All Comments</h3>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gradient-to-r from-purple-500 to-purple-600 text-white border-b">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold">👤 Author</th>
                <th class="px-6 py-4 text-left text-sm font-semibold">📝 Comment</th>
                <th class="px-6 py-4 text-left text-sm font-semibold">📋 Task</th>
                <th class="px-6 py-4 text-left text-sm font-semibold">📅 Posted</th>
                <th class="px-6 py-4 text-center text-sm font-semibold">⚙️ Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($comments as $comment)
                <tr class="border-b hover:bg-purple-50 transition duration-200">
                    <td class="px-6 py-4 text-sm">
                        <div class="flex items-center gap-3">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-purple-100 text-purple-600 font-bold">
                                {{ substr($comment->user->Name, 0, 1) }}
                            </span>
                            <div>
                                <p class="font-semibold text-gray-800">{{ $comment->user->Name }}</p>
                                <p class="text-xs text-gray-500">ID: {{ $comment->CommentID }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <p class="text-gray-700 line-clamp-2">{{ Str::limit($comment->CommentText, 50) }}</p>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-indigo-100 text-indigo-800">
                            📋 {{ Str::limit($comment->task->Title, 25) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $comment->DatePosted->format('M d, Y H:i') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('tasks.show', $comment->task->TaskID) }}" class="inline-flex items-center px-3 py-1 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition font-semibold text-xs">
                                👁️ View
                            </a>
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
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
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                        📭 No comments found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $comments->links() }}
</div>
@endsection
