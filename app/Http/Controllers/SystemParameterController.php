<?php

namespace App\Http\Controllers;

use App\Models\SystemParameter;
use Illuminate\Http\Request;

class SystemParameterController extends Controller
{
    /**
     * Display a listing of system parameters.
     */
    public function index()
    {
        $parameters = SystemParameter::paginate(15);
        return view('system-parameters.index', compact('parameters'));
    }

    /**
     * Show the form for creating a new system parameter.
     */
    public function create()
    {
        return view('system-parameters.create');
    }

    /**
     * Store a newly created system parameter in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ParameterType' => 'required|string|unique:system_parameters,ParameterType',
            'ParameterValue' => 'required|string',
        ]);

        $parameter = SystemParameter::create($validated);

        return redirect()->route('system-parameters.show', $parameter->ParameterID)
                       ->with('success', 'Parameter created successfully!');
    }

    /**
     * Display the specified system parameter.
     */
    public function show(SystemParameter $parameter)
    {
        return view('system-parameters.show', compact('parameter'));
    }

    /**
     * Show the form for editing the specified parameter.
     */
    public function edit(SystemParameter $parameter)
    {
        return view('system-parameters.edit', compact('parameter'));
    }

    /**
     * Update the specified system parameter in storage.
     */
    public function update(Request $request, SystemParameter $parameter)
    {
        $validated = $request->validate([
            'ParameterValue' => 'required|string',
        ]);

        $parameter->update($validated);

        return redirect()->route('system-parameters.show', $parameter->ParameterID)
                       ->with('success', 'Parameter updated successfully!');
    }

    /**
     * Remove the specified system parameter from storage.
     */
    public function destroy(SystemParameter $parameter)
    {
        $parameter->delete();

        return redirect()->route('system-parameters.index')
                       ->with('success', 'Parameter deleted successfully!');
    }

    /**
     * Get a system parameter by type.
     */
    public function getByType($type)
    {
        $parameter = SystemParameter::where('ParameterType', $type)->first();

        if (!$parameter) {
            return redirect()->route('system-parameters.index')
                           ->with('error', 'Parameter not found');
        }

        return view('system-parameters.show', compact('parameter'));
    }
}
