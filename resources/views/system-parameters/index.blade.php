@extends('layouts.app')

@section('title', 'System Parameters - Task Management System')
@section('page-title', 'System Parameters')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h3 class="text-2xl font-bold text-gray-800">⚙️ System Parameters</h3>
    <a href="{{ route('system-parameters.create') }}" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
        ➕ Add Parameter
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gradient-to-r from-slate-500 to-slate-600 text-white border-b">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold">🔧 Parameter Type</th>
                <th class="px-6 py-4 text-left text-sm font-semibold">📋 Parameter Value</th>
                <th class="px-6 py-4 text-left text-sm font-semibold">🕐 Updated</th>
                <th class="px-6 py-4 text-center text-sm font-semibold">⚙️ Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($parameters as $parameter)
                <tr class="border-b hover:bg-slate-50 transition duration-200">
                    <td class="px-6 py-4 text-sm">
                        <div class="flex items-center gap-3">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-slate-100 text-slate-600 font-bold">
                                {{ substr($parameter->ParameterType, 0, 1) }}
                            </span>
                            <div>
                                <p class="font-semibold text-gray-800">{{ $parameter->ParameterType }}</p>
                                <p class="text-xs text-gray-500">ID: {{ $parameter->ParameterID }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-slate-100 text-slate-800">
                            {{ Str::limit($parameter->ParameterValue, 40) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $parameter->updated_at->format('M d, Y H:i') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('system-parameters.show', $parameter) }}" class="inline-flex items-center px-3 py-1 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition font-semibold text-xs">
                                👁️ View
                            </a>
                            <a href="{{ route('system-parameters.edit', $parameter) }}" class="inline-flex items-center px-3 py-1 rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition font-semibold text-xs">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('system-parameters.destroy', $parameter) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
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
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                        📭 No parameters found. <a href="{{ route('system-parameters.create') }}" class="text-slate-500 hover:underline font-semibold">Create one</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $parameters->links() }}
</div>
@endsection
