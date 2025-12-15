@extends('layouts.app')

@section('title', 'Create User - Task Management System')
@section('page-title', 'Create New User')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Create New User</h3>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="Name" class="block text-sm font-semibold text-gray-800 mb-2">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="Name" 
                        name="Name" 
                        class="form-input @error('Name') border-red-500 @enderror"
                        placeholder="Enter full name"
                        value="{{ old('Name') }}"
                        required
                    >
                    @error('Name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="Email" class="block text-sm font-semibold text-gray-800 mb-2">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="email" 
                        id="Email" 
                        name="Email" 
                        class="form-input @error('Email') border-red-500 @enderror"
                        placeholder="Enter email address"
                        value="{{ old('Email') }}"
                        required
                    >
                    @error('Email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="Role" class="block text-sm font-semibold text-gray-800 mb-2">
                        Role <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="Role" 
                        name="Role" 
                        class="form-input @error('Role') border-red-500 @enderror"
                        required
                    >
                        <option value="">Select a role</option>
                        <option value="admin" {{ old('Role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="manager" {{ old('Role') == 'manager' ? 'selected' : '' }}>Manager</option>
                        <option value="user" {{ old('Role') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    @error('Role')
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
                        <option value="">Select a status</option>
                        <option value="active" {{ old('Status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('Status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('Status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="DepartmentID" class="block text-sm font-semibold text-gray-800 mb-2">
                    Department <span class="text-red-500">*</span>
                </label>
                <select 
                    id="DepartmentID" 
                    name="DepartmentID" 
                    class="form-input @error('DepartmentID') border-red-500 @enderror"
                    required
                >
                    <option value="">Select a department</option>
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

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-800 mb-2">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input @error('password') border-red-500 @enderror"
                        placeholder="Enter password"
                        required
                    >
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-800 mb-2">
                        Confirm Password <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="form-input"
                        placeholder="Confirm password"
                        required
                    >
                </div>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="btn-primary text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg flex-1">
                    Create User
                </button>
                <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-semibold flex-1 text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
