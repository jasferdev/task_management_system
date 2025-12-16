@extends('layouts.main')

@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>report_tasks</h3>
        <a href="{{ route('report-tasks.create') }}" class="btn btn-primary">Create ReportTask</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Report Title</th>
                <th>Task Title</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($reportTasks as $rt)
            <tr>
                <td>{{ $rt->id }}</td>
                <td>{{ $rt->report->title }}</td>
                <td>{{ $rt->task->title }}</td>
                <td>
                    <a href="{{ route('report-tasks.show', $rt) }}" class="btn btn-sm btn-info">View</a>

                    <form action="{{ route('report-tasks.destroy', $rt) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Remove this task from report?')">
                            Remove
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center text-muted">No linked tasks found.</td></tr>
        @endforelse
        </tbody>
    </table>

</div>
@endsection