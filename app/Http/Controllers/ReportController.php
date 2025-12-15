<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Task;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of reports.
     */
    public function index()
    {
        $reports = Report::with('creator', 'tasks')->paginate(15);
        return view('reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new report.
     */
    public function create()
    {
        $tasks = Task::all();
        return view('reports.create', compact('tasks'));
    }

    /**
     * Store a newly created report in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Title' => 'required|string|max:255',
            'task_ids' => 'array|exists:tasks,TaskID',
        ]);

        $taskIds = $validated['task_ids'] ?? [];
        unset($validated['task_ids']);

        $validated['CreatedBy'] = auth()->id() ?? 1; // Default to user 1 if not authenticated
        $validated['DateGenerated'] = now();
        $report = Report::create($validated);

        if (!empty($taskIds)) {
            $report->tasks()->sync($taskIds);
        }

        return redirect()->route('reports.show', $report->ReportID)
                       ->with('success', 'Report created successfully!');
    }

    /**
     * Display the specified report.
     */
    public function show(Report $report)
    {
        $report->load('creator', 'tasks');
        return view('reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified report.
     */
    public function edit(Report $report)
    {
        $tasks = Task::all();
        $report->load('tasks');
        return view('reports.edit', compact('report', 'tasks'));
    }

    /**
     * Update the specified report in storage.
     */
    public function update(Request $request, Report $report)
    {
        $validated = $request->validate([
            'Title' => 'required|string|max:255',
            'task_ids' => 'array|exists:tasks,TaskID',
        ]);

        $taskIds = $validated['task_ids'] ?? [];
        unset($validated['task_ids']);

        $report->update($validated);

        if (!empty($taskIds)) {
            $report->tasks()->sync($taskIds);
        }

        return redirect()->route('reports.show', $report->ReportID)
                       ->with('success', 'Report updated successfully!');
    }

    /**
     * Remove the specified report from storage.
     */
    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()->route('reports.index')
                       ->with('success', 'Report deleted successfully!');
    }

    /**
     * Add a task to a report.
     */
    public function addTask(Request $request, Report $report)
    {
        $validated = $request->validate([
            'TaskID' => 'required|exists:tasks,TaskID',
        ]);

        $report->tasks()->attach($validated['TaskID']);

        return redirect()->route('reports.show', $report->ReportID)
                       ->with('success', 'Task added to report!');
    }

    /**
     * Remove a task from a report.
     */
    public function removeTask(Report $report, $taskId)
    {
        $report->tasks()->detach($taskId);

        return redirect()->route('reports.show', $report->ReportID)
                       ->with('success', 'Task removed from report!');
    }
}
