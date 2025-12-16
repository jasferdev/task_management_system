@extends('layouts.layout')

@section('content')
<div class="card p-4">
    <h3 class="mb-3">Attach Task to Report</h3>

    <form action="{{ route('report-tasks.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-bold">Report</label>
            <select name="report_id" class="form-select" required>
                <option value="" disabled selected>-- Choose Report --</option>
                @foreach($reports as $report)
                    <option value="{{ $report->id }}">{{ $report->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Task</label>
            <select name="task_id" class="form-select" required>
                <option value="" disabled selected>-- Choose Task --</option>
                @foreach($tasks as $task)
                    <option value="{{ $task->id }}">{{ $task->title }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Attach</button>
        <a href="{{ route('report-tasks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection