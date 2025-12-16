@extends('layouts.layout')

@section('content')
<div class="card p-4">
    <h3 class="mb-3">Create System Parameter</h3>

    <form action="{{ route('system-parameters.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-bold">Key</label>
            <input type="text" name="key" class="form-control" required value="{{ old('key') }}">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Value</label>
            <input type="text" name="value" class="form-control" required value="{{ old('value') }}">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('system-parameters.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

