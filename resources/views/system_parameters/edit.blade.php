@extends('layouts.layout')

@section('content')
<div class="card p-4">
    <h3 class="mb-3">Edit System Parameter</h3>

    <form action="{{ route('system-parameters.update', $systemParameter) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Key</label>
            <input type="text" name="key" class="form-control"
                   value="{{ old('key', $systemParameter->key) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Value</label>
            <input type="text" name="value" class="form-control"
                   value="{{ old('value', $systemParameter->value) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $systemParameter->description) }}</textarea>
        </div>

        <button class="btn btn-warning">Update</button>
        <a href="{{ route('system-parameters.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

