<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SystemParameterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Implicit route model binding - map route parameters to custom key names
Route::bind('department', function ($value) {
    return \App\Models\Department::where('DepartmentID', $value)->firstOrFail();
});

Route::bind('user', function ($value) {
    return \App\Models\User::where('UserID', $value)->firstOrFail();
});

Route::bind('task', function ($value) {
    return \App\Models\Task::where('TaskID', $value)->firstOrFail();
});

Route::bind('comment', function ($value) {
    return \App\Models\Comment::where('CommentID', $value)->firstOrFail();
});

Route::bind('report', function ($value) {
    return \App\Models\Report::where('ReportID', $value)->firstOrFail();
});

Route::bind('parameter', function ($value) {
    return \App\Models\SystemParameter::where('ParameterID', $value)->firstOrFail();
});

Route::bind('system_parameter', function ($value) {
    return \App\Models\SystemParameter::where('ParameterID', $value)->firstOrFail();
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'departmentCount' => \App\Models\Department::count(),
        'userCount' => \App\Models\User::count(),
        'taskCount' => \App\Models\Task::count(),
        'reportCount' => \App\Models\Report::count(),
        'pendingCount' => \App\Models\Task::where('Status', 'pending')->count(),
        'inProgressCount' => \App\Models\Task::where('Status', 'in_progress')->count(),
        'completedCount' => \App\Models\Task::where('Status', 'completed')->count(),
        'cancelledCount' => \App\Models\Task::where('Status', 'cancelled')->count(),
        'recentTasks' => \App\Models\Task::with('department')->latest('TaskID')->take(5)->get(),
    ]);
})->name('dashboard');

// Authentication Routes (Placeholder - can be extended with Laravel Breeze)
Route::get('/login', function () {
    return redirect('/users')->with('info', 'Login functionality coming soon. Using user management system instead.');
})->name('login');

Route::get('/register', function () {
    return redirect('/users/create')->with('info', 'Create new user via user management system.');
})->name('register');

Route::post('/logout', function () {
    return redirect('/')->with('success', 'Logged out successfully.');
})->name('logout');

// Department Routes
Route::resource('departments', DepartmentController::class);

// User Routes
Route::resource('users', UserController::class);
Route::post('users/{user}/change-password', [UserController::class, 'changePassword'])->name('users.changePassword');

// Task Routes
Route::resource('tasks', TaskController::class);
Route::get('tasks/status/{status}', [TaskController::class, 'getByStatus'])->name('tasks.byStatus');
Route::get('tasks/user/{userId}', [TaskController::class, 'getAssignedToUser'])->name('tasks.assignedToUser');

// Comment Routes
Route::resource('comments', CommentController::class);
Route::get('tasks/{taskId}/comments', [CommentController::class, 'getTaskComments'])->name('comments.byTask');

// Report Routes
Route::resource('reports', ReportController::class);
Route::post('reports/{report}/add-task', [ReportController::class, 'addTask'])->name('reports.addTask');
Route::delete('reports/{report}/remove-task/{taskId}', [ReportController::class, 'removeTask'])->name('reports.removeTask');

// System Parameters Routes
Route::resource('system-parameters', SystemParameterController::class);
Route::get('system-parameters/type/{type}', [SystemParameterController::class, 'getByType'])->name('system-parameters.byType');

require __DIR__.'/auth.php';
