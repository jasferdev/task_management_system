@extends('layouts.app')

@section('title', 'Users - Task Management System')
@section('page-title', 'Users Management')

@section('content')
<div class="page-content">
    <!-- Header Section -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;">
        <div>
            <h2 style="color: #2c3e50; font-size: 2.25rem; font-weight: 800; margin: 0 0 0.5rem 0;">Team Members</h2>
            <p style="color: #7f8c8d; margin: 0; font-size: 0.95rem;">Manage your team members and their roles</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-primary" style="gap: 0.75rem;">
            <i class="fas fa-user-plus"></i> Add New User
        </a>
    </div>

    <!-- Users Grid/Table -->
    <div class="card">
        <div class="card-header" style="display: flex; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <i class="fas fa-users" style="color: #667eea;"></i> Users List
            </div>
            <span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 700; font-size: 0.8rem;">
                {{ $users->total() }} Total
            </span>
        </div>
        <div class="card-body">
            @forelse($users as $user)
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 1.5rem; border-bottom: 1px solid #f0f0f0; transition: background 0.2s ease; border-radius: 0.5rem; margin-bottom: 0.75rem;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='transparent'">
                    <!-- User Info -->
                    <div style="display: flex; align-items: center; gap: 1.5rem; flex: 1;">
                        <!-- Avatar -->
                        <div style="width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-weight: 700; flex-shrink: 0;">
                            {{ substr($user->Name, 0, 1) }}
                        </div>

                        <!-- Name & Details -->
                        <div style="flex: 1;">
                            <h4 style="margin: 0 0 0.5rem 0; color: #2c3e50; font-weight: 700;">{{ $user->Name }}</h4>
                            <div style="display: flex; align-items: center; gap: 1.5rem; font-size: 0.85rem;">
                                <span style="color: #7f8c8d;"><i class="fas fa-envelope" style="margin-right: 0.5rem;"></i>{{ $user->Email }}</span>
                                <span style="color: #7f8c8d;"><i class="fas fa-id-card" style="margin-right: 0.5rem;"></i>{{ $user->UserID }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Role Badge -->
                    <div style="margin-right: 1.5rem;">
                        <span class="badge badge-{{ $user->Role === 'admin' ? 'danger' : ($user->Role === 'manager' ? 'warning' : 'info') }}" style="text-transform: capitalize;">
                            <i class="fas fa-{{ $user->Role === 'admin' ? 'crown' : ($user->Role === 'manager' ? 'briefcase' : 'user') }}" style="margin-right: 0.25rem;"></i>
                            {{ $user->Role }}
                        </span>
                    </div>

                    <!-- Department Badge -->
                    <div style="margin-right: 1.5rem;">
                        <span class="badge badge-info">
                            <i class="fas fa-building" style="margin-right: 0.25rem;"></i>
                            {{ $user->department ? $user->department->DepartmentName : 'No Department' }}
                        </span>
                    </div>

                    <!-- Status Badge -->
                    <div style="margin-right: 1.5rem;">
                        @if($user->Status === 'active')
                            <span class="badge badge-success">
                                <i class="fas fa-check-circle" style="margin-right: 0.25rem;"></i> Active
                            </span>
                        @else
                            <span class="badge badge-danger">
                                <i class="fas fa-ban" style="margin-right: 0.25rem;"></i> Inactive
                            </span>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('users.show', $user) }}" class="btn" style="background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); color: white; padding: 0.625rem 0.875rem; font-size: 0.8rem; border: none;" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('users.edit', $user) }}" class="btn" style="background: #ecf0f1; color: #2c3e50; padding: 0.625rem 0.875rem; font-size: 0.8rem; border: none;" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); color: white; padding: 0.625rem 0.875rem; font-size: 0.8rem; border: none; cursor: pointer;" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 3rem 1rem;">
                    <i class="fas fa-users" style="font-size: 4rem; color: #ecf0f1; margin-bottom: 1rem; display: block;"></i>
                    <h3 style="color: #7f8c8d; margin-bottom: 0.5rem;">No users found</h3>
                    <p style="color: #bdc3c7; margin-bottom: 1.5rem;">Add your first team member to get started</p>
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Add User
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination -->
    <div style="margin-top: 2rem;">
        {{ $users->links() }}
    </div>
</div>

<style>
    .page-content a[rel*='prev'],
    .page-content a[rel*='next'],
    .page-content .pagination span {
        padding: 0.625rem 1rem;
        border-radius: 0.5rem;
        border: 2px solid #e0e0e0;
        background: white;
        color: #667eea;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
        margin: 0 0.25rem;
    }

    .page-content .pagination span.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: #667eea;
    }

    .page-content a[rel*='prev']:hover,
    .page-content a[rel*='next']:hover {
        background: #ecf0f1;
        border-color: #667eea;
    }
</style>
@endsection
