@extends('layouts.layout')

@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>System Parameters</h3>
        <a href="{{ route('system-parameters.create') }}" class="btn btn-primary">Create Parameter</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Key</th>
                <th>Value</th>
                <th>Description</th>
                <th width="180">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($systemParameters as $param)
            <tr>
                <td>{{ $param->key }}</td>
                <td>{{ $param->value }}</td>
                <td>{{ $param->description }}</td>
                <td>
                    <a href="{{ route('system-parameters.edit', $param) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('system-parameters.destroy', $param) }}"
                          method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this parameter?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
