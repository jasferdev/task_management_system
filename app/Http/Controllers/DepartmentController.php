<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of departments.
     */
    public function index()
    {
        $departments = Department::with('users', 'tasks')->paginate(15);
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new department.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created department in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'DepartmentName' => 'required|string|unique:departments,DepartmentName',
        ]);

        $department = Department::create($validated);

        return redirect()->route('departments.show', $department->DepartmentID)
                       ->with('success', 'Department created successfully!');
    }

    /**
     * Display the specified department.
     */
    public function show(Department $department)
    {
        $department->load('users', 'tasks');
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified department.
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified department in storage.
     */
    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'DepartmentName' => 'required|string|unique:departments,DepartmentName,' . $department->DepartmentID . ',DepartmentID',
        ]);

        $department->update($validated);

        return redirect()->route('departments.show', $department->DepartmentID)
                       ->with('success', 'Department updated successfully!');
    }

    /**
     * Remove the specified department from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')
                       ->with('success', 'Department deleted successfully!');
    }
}
