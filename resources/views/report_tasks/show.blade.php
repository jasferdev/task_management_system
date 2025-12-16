@extends('layouts.app')

@section('content')
<div class="card p-4">

    <h3>Report Task Details</h3>

    <p><strong>Report:</strong> {{ $reportTask->report->title }}</p>
    <p><strong>Task:</strong> {{ $reportTask->task->title }}</p>

    <a href="{{ route('report-tasks.index') }}" class="btn btn-secondary mt-3">Back</a>

</div>
@endsection

