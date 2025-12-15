<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = User::with('department', 'createdTasks', 'assignedTasks')->paginate(15);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $departments = Department::all();
        return view('users.create', compact('departments'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'Email' => 'required|email|unique:users,Email',
            'Role' => 'required|string|in:admin,manager,user',
            'Status' => 'required|string|in:active,inactive',
            'DepartmentID' => 'required|exists:departments,DepartmentID',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        return redirect()->route('users.show', $user->UserID)
                       ->with('success', 'User created successfully!');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        $user->load('department', 'createdTasks', 'assignedTasks', 'comments', 'reports');
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $departments = Department::all();
        return view('users.edit', compact('user', 'departments'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'Email' => 'required|email|unique:users,Email,' . $user->UserID . ',UserID',
            'Role' => 'required|string|in:admin,manager,user',
            'Status' => 'required|string|in:active,inactive',
            'DepartmentID' => 'required|exists:departments,DepartmentID',
        ]);

        $user->update($validated);

        return redirect()->route('users.show', $user->UserID)
                       ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
                       ->with('success', 'User deleted successfully!');
    }

    /**
     * Change the password of the specified user.
     */
    public function changePassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update(['password' => Hash::make($validated['password'])]);

        return redirect()->route('users.show', $user->UserID)
                       ->with('success', 'Password updated successfully!');
    }
}
