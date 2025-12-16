@extends('layouts.app')

@section('title', 'Dashboard - Task Management System')
@section('page-title', '📊 Dashboard')

@section('content')
<div class="page-content">
    <!-- Welcome Header -->
    <div style="margin-bottom: 3rem; animation: fadeIn 0.5s ease;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2 style="color: #2c3e50; margin-bottom: 0.25rem; font-size: 2.25rem; font-weight: 800;">Welcome back, {{ auth()?->user()?->Name ?? 'Guest' }}!</h2>
                <p style="color: #7f8c8d; font-size: 1rem; margin: 0;">{{ now()->format('l, F j, Y') }}</p>
            </div>
            <div style="text-align: right;">
                <div style="font-size: 3.5rem; opacity: 0.1;">📊</div>
            </div>
        </div>
    </div>

    <!-- Primary Stats Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.75rem; margin-bottom: 3rem;">
        <!-- Total Departments -->
        <div class="card" style="animation: slideUp 0.5s ease 0.1s both;">
            <div class="stat-card">
                <div>
                    <div class="stat-number" style="color: #667eea;">{{ $departmentCount }}</div>
                    <div class="stat-label">Total Departments</div>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(118, 75, 162, 0.1) 100%); color: #667eea;">
                    <i class="fas fa-sitemap"></i>
                </div>
            </div>
        </div>

        <!-- Active Users -->
        <div class="card" style="animation: slideUp 0.5s ease 0.2s both;">
            <div class="stat-card">
                <div>
                    <div class="stat-number" style="color: #ec4899;">{{ $userCount }}</div>
                    <div class="stat-label">Active Users</div>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, rgba(236, 72, 153, 0.15) 0%, rgba(244, 63, 94, 0.1) 100%); color: #ec4899;">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <!-- Total Tasks -->
        <div class="card" style="animation: slideUp 0.5s ease 0.3s both;">
            <div class="stat-card">
                <div>
                    <div class="stat-number" style="color: #06b6d4;">{{ $taskCount }}</div>
                    <div class="stat-label">Total Tasks</div>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, rgba(6, 182, 212, 0.15) 0%, rgba(34, 197, 94, 0.1) 100%); color: #06b6d4;">
                    <i class="fas fa-tasks"></i>
                </div>
            </div>
        </div>

        <!-- Reports -->
        <div class="card" style="animation: slideUp 0.5s ease 0.4s both;">
            <div class="stat-card">
                <div>
                    <div class="stat-number" style="color: #8b5cf6;">{{ $reportCount }}</div>
                    <div class="stat-label">Reports Created</div>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.15) 0%, rgba(168, 85, 247, 0.1) 100%); color: #8b5cf6;">
                    <i class="fas fa-chart-pie"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Task Status Overview -->
    <div style="margin-bottom: 3rem;">
        <h3 style="color: #2c3e50; font-size: 1.25rem; font-weight: 700; margin-bottom: 1.5rem; letter-spacing: -0.3px;">Task Overview</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.5rem;">
            <!-- Pending -->
            <div class="card" style="border-left: 4px solid #10b981; animation: slideUp 0.5s ease 0.1s both;">
                <div class="card-body">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="width: 48px; height: 48px; border-radius: 0.75rem; background: rgba(16, 185, 129, 0.1); display: flex; align-items: center; justify-content: center; color: #10b981; font-size: 1.5rem;">
                            <i class="fas fa-hourglass-start"></i>
                        </div>
                        <div>
                            <div style="font-weight: 700; color: #7f8c8d; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Pending</div>
                        </div>
                    </div>
                    <div style="font-size: 2.25rem; font-weight: 800; color: #10b981; margin-bottom: 0.5rem;">{{ $pendingCount }}</div>
                    <p style="color: #bdc3c7; font-size: 0.9rem; margin: 0;">Tasks waiting to start</p>
                </div>
            </div>

            <!-- In Progress -->
            <div class="card" style="border-left: 4px solid #f59e0b; animation: slideUp 0.5s ease 0.2s both;">
                <div class="card-body">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="width: 48px; height: 48px; border-radius: 0.75rem; background: rgba(245, 158, 11, 0.1); display: flex; align-items: center; justify-content: center; color: #f59e0b; font-size: 1.5rem;">
                            <i class="fas fa-spinner"></i>
                        </div>
                        <div>
                            <div style="font-weight: 700; color: #7f8c8d; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">In Progress</div>
                        </div>
                    </div>
                    <div style="font-size: 2.25rem; font-weight: 800; color: #f59e0b; margin-bottom: 0.5rem;">{{ $inProgressCount }}</div>
                    <p style="color: #bdc3c7; font-size: 0.9rem; margin: 0;">Currently being worked on</p>
                </div>
            </div>

            <!-- Completed -->
            <div class="card" style="border-left: 4px solid #3b82f6; animation: slideUp 0.5s ease 0.3s both;">
                <div class="card-body">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="width: 48px; height: 48px; border-radius: 0.75rem; background: rgba(59, 130, 246, 0.1); display: flex; align-items: center; justify-content: center; color: #3b82f6; font-size: 1.5rem;">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <div style="font-weight: 700; color: #7f8c8d; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Completed</div>
                        </div>
                    </div>
                    <div style="font-size: 2.25rem; font-weight: 800; color: #3b82f6; margin-bottom: 0.5rem;">{{ $completedCount }}</div>
                    <p style="color: #bdc3c7; font-size: 0.9rem; margin: 0;">Successfully finished</p>
                </div>
            </div>

            <!-- Cancelled -->
            <div class="card" style="border-left: 4px solid #ef4444; animation: slideUp 0.5s ease 0.4s both;">
                <div class="card-body">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="width: 48px; height: 48px; border-radius: 0.75rem; background: rgba(239, 68, 68, 0.1); display: flex; align-items: center; justify-content: center; color: #ef4444; font-size: 1.5rem;">
                            <i class="fas fa-ban"></i>
                        </div>
                        <div>
                            <div style="font-weight: 700; color: #7f8c8d; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Cancelled</div>
                        </div>
                    </div>
                    <div style="font-size: 2.25rem; font-weight: 800; color: #ef4444; margin-bottom: 0.5rem;">{{ $cancelledCount }}</div>
                    <p style="color: #bdc3c7; font-size: 0.9rem; margin: 0;">Cancelled or archived</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Tasks Table -->
    <div class="card" style="animation: slideUp 0.5s ease 0.5s both;">
        <div class="card-header" style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <i class="fas fa-list-check" style="margin-right: 0.75rem; color: #667eea;"></i> Recent Tasks
            </div>
            <a href="/tasks" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.8rem;">
                <i class="fas fa-arrow-right"></i> View All
            </a>
        </div>
        <div class="card-body">
            @if($recentTasks->count())
                <div style="overflow-x: auto;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Due Date</th>
                                <th>Assigned To</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentTasks as $task)
                                <tr style="transition: background 0.2s ease;">
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                                            <i class="fas fa-circle" style="font-size: 0.5rem; color: #667eea; margin-right: 0.25rem;"></i>
                                            <strong style="color: #2c3e50;">{{ $task->Title }}</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $task->Priority === 'critical' ? 'danger' : ($task->Priority === 'high' ? 'warning' : 'info') }}">
                                            <i class="fas fa-{{ $task->Priority === 'critical' ? 'fire' : 'flag' }}" style="margin-right: 0.25rem;"></i>
                                            {{ ucfirst($task->Priority) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $task->Status === 'completed' ? 'success' : ($task->Status === 'in_progress' ? 'warning' : 'info') }}">
                                            {{ ucfirst(str_replace('_', ' ', $task->Status)) }}
                                        </span>
                                    </td>
                                    <td style="color: #7f8c8d; font-weight: 500;">{{ $task->DueDate ? $task->DueDate->format('M d, Y') : 'N/A' }}</td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <div style="width: 28px; height: 28px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700;">
                                                {{ substr($task->user?->Name ?? 'U', 0, 1) }}
                                            </div>
                                            {{ $task->user?->Name ?? 'Unassigned' }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="text-align: center; padding: 3rem 1rem;">
                    <i class="fas fa-inbox" style="font-size: 3rem; color: #ecf0f1; margin-bottom: 1rem; display: block;"></i>
                    <p style="color: #7f8c8d; font-size: 1rem;">No recent tasks available yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection

