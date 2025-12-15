@extends('layouts.app')

@section('title', 'Edit System Parameter - Task Management System')
@section('page-title', 'Edit System Parameter')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Edit System Parameter</h3>

        <form action="{{ route('system-parameters.update', $parameter) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="ParameterType" class="block text-sm font-semibold text-gray-800 mb-2">
                    Parameter Type <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="ParameterType" 
                    name="ParameterType" 
                    class="form-input @error('ParameterType') border-red-500 @enderror"
                    placeholder="e.g., max_task_deadline, default_priority"
                    value="{{ old('ParameterType', $parameter->ParameterType) }}"
                    disabled
                >
                <p class="text-xs text-gray-500 mt-2">Parameter type cannot be changed</p>
            </div>

            <div class="mb-6">
                <label for="ParameterValue" class="block text-sm font-semibold text-gray-800 mb-2">
                    Parameter Value <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="ParameterValue" 
                    name="ParameterValue" 
                    rows="6"
                    class="form-input @error('ParameterValue') border-red-500 @enderror"
                    placeholder="Enter parameter value"
                    required
                >{{ old('ParameterValue', $parameter->ParameterValue) }}</textarea>
                @error('ParameterValue')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="btn-primary text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg flex-1">
                    Update Parameter
                </button>
                <a href="{{ route('system-parameters.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-semibold flex-1 text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
