@extends('layouts.layout')

@section('content')
<div class="card p-4">
    <h3>System Parameter Details</h3>

    <p><strong>Key:</strong> {{ $systemParameter->key }}</p>
    <p><strong>Value:</strong> {{ $systemParameter->value }}</p>
    <p><strong>Description:</strong> {{ $systemParameter->description }}</p>

    <a href="{{ route('system-parameters.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
