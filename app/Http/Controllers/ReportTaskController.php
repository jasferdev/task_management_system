<?php

namespace App\Http\Controllers;

use App\Models\ReportTask;
use App\Models\Report;
use App\Models\Task;
use Illuminate\Http\Request;

class ReportTaskController extends Controller
{
    public function index()
    {
        $reportTasks = ReportTask::with(['report', 'task'])->get();
        return view('report_tasks.index', compact('reportTasks'));
    }

    public function create()
    {
        $reports = Report::all();
        $tasks = Task::all();

        return view('report_tasks.create', compact('reports', 'tasks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'report_id' => 'required|exists:reports,id',
            'task_id'   => 'required|exists:tasks,id',
        ]);

        ReportTask::create($validated);

        return redirect()
            ->route('report-tasks.index')
            ->with('success', 'Task attached to report successfully!');
    }

    public function show(ReportTask $reportTask)
    {
        $reportTask->load(['report', 'task']);

        return view('report_tasks.show', compact('reportTask'));
    }

    public function edit(ReportTask $reportTask)
    {
        $reports = Report::all();
        $tasks   = Task::all();

        return view('report_tasks.edit', compact('reportTask', 'reports', 'tasks'));
    }

    public function update(Request $request, ReportTask $reportTask)
    {
        $validated = $request->validate([
            'report_id' => 'required|exists:reports,id',
            'task_id'   => 'required|exists:tasks,id',
        ]);

        $reportTask->update($validated);

        return redirect()
            ->route('report-tasks.index')
            ->with('success', 'Link updated successfully!');
    }

    public function destroy(ReportTask $reportTask)
    {
        $reportTask->delete();

        return redirect()
            ->route('report-tasks.index')
            ->with('success', 'Link removed successfully!');
    }
}
