@extends('layouts.app')

@section('title', 'View System Parameter - Task Management System')
@section('page-title', 'System Parameter Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h3 class="text-3xl font-bold text-gray-800">{{ $parameter->ParameterType }}</h3>
                <p class="text-gray-600 mt-1">Parameter ID: {{ $parameter->ParameterID }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('system-parameters.edit', $parameter) }}" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold">
                    Edit
                </a>
                <form action="{{ route('system-parameters.destroy', $parameter) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg font-semibold">
                        Delete
                    </button>
                </form>
                <a href="{{ route('system-parameters.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold">
                    Back
                </a>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                <p class="text-gray-600 text-sm">Parameter ID</p>
                <p class="text-lg font-bold text-gray-800">{{ $parameter->ParameterID }}</p>
            </div>
            <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                <p class="text-gray-600 text-sm">Created</p>
                <p class="text-sm font-semibold">{{ $parameter->created_at->format('M d, Y H:i') }}</p>
            </div>
            <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                <p class="text-gray-600 text-sm">Last Updated</p>
                <p class="text-sm font-semibold">{{ $parameter->updated_at->format('M d, Y H:i') }}</p>
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
            <h4 class="text-sm font-semibold text-gray-700 mb-3">Parameter Value</h4>
            <pre class="bg-white p-4 rounded border border-gray-300 overflow-x-auto text-sm">{{ $parameter->ParameterValue }}</pre>
        </div>
    </div>
</div>
@endsection
