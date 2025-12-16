@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $report->title }}</h1>

    <p><strong>Created By:</strong> {{ $report->creator->name ?? '' }}</p>
    <p><strong>Created At:</strong> {{ $report->created_at }}</p>
    <p><strong>Description:</strong><br>{{ $report->description }}</p>

    <hr>

    <h3>Tasks in this Report</h3>

    @if($report->tasks->count())
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Task ID</th>
                <th>Title</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($report->tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ ucwords(str_replace('_',' ',$task->status)) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>No tasks attached yet.</p>
    @endif
<a href="{{ route('reports.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
