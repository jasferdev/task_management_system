<div class="mb-3">
    <label class="form-label fw-bold">Select Report</label>
    <select name="report_id" class="form-select" required>
        <option value="" disabled selected>-- Choose Report --</option>

        @foreach($reports as $report)
            <option value="{{ $report->id }}"
                @selected(old('report_id', $reportTask->report_id ?? '') == $report->id)>
                [{{ $report->id }}] {{ $report->title }}
            </option>
        @endforeach
    </select>
    @error('report_id') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Select Task</label>
    <select name="task_id" class="form-select" required>
        <option value="" disabled selected>-- Choose Task --</option>

        @foreach($tasks as $task)
            <option value="{{ $task->id }}"
                @selected(old('task_id', $reportTask->task_id ?? '') == $task->id)>
                [{{ $task->id }}] {{ $task->title }}
            </option>
        @endforeach
    </select>
    @error('task_id') <small class="text-danger">{{ $message }}</small> @enderror
</div>
