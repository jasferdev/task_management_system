@extends('layouts.app')

@section('title', 'Edit User - Task Management System')
@section('page-title', 'Edit User')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Edit User</h3>

        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

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
                        value="{{ old('Name', $user->Name) }}"
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
                        value="{{ old('Email', $user->Email) }}"
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
                        <option value="admin" {{ old('Role', $user->Role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="manager" {{ old('Role', $user->Role) == 'manager' ? 'selected' : '' }}>Manager</option>
                        <option value="user" {{ old('Role', $user->Role) == 'user' ? 'selected' : '' }}>User</option>
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
                        <option value="active" {{ old('Status', $user->Status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('Status', $user->Status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
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
                        <option value="{{ $dept->DepartmentID }}" {{ old('DepartmentID', $user->DepartmentID) == $dept->DepartmentID ? 'selected' : '' }}>
                            {{ $dept->DepartmentName }}
                        </option>
                    @endforeach
                </select>
                @error('DepartmentID')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="btn-primary text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg flex-1">
                    Update User
                </button>
                <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-semibold flex-1 text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
