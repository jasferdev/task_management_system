<div class="mb-3">
    <label class="form-label">Key</label>
    <input type="text" name="key" class="form-control"
           value="{{ old('key', $parameter->key ?? '') }}">
    @error('key') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Value</label>
    <input type="text" name="value" class="form-control"
           value="{{ old('value', $parameter->value ?? '') }}">
    @error('value') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $parameter->description ?? '') }}</textarea>
    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
</div>