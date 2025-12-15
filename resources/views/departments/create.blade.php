@extends('layouts.app')

@section('title', 'Create Department - Task Management System')
@section('page-title', 'Create New Department')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Create New Department</h3>

        <form action="{{ route('departments.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="DepartmentName" class="block text-sm font-semibold text-gray-800 mb-2">
                    Department Name <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="DepartmentName" 
                    name="DepartmentName" 
                    class="form-input @error('DepartmentName') border-red-500 @enderror"
                    placeholder="Enter department name"
                    value="{{ old('DepartmentName') }}"
                    required
                >
                @error('DepartmentName')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="btn-primary text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg flex-1">
                    Create Department
                </button>
                <a href="{{ route('departments.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-semibold flex-1 text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
