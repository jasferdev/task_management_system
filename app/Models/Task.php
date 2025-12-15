<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'TaskID';
    public $timestamps = true;

    protected $fillable = [
        'Title',
        'Description',
        'Priority',
        'Status',
        'Deadline',
        'CreatedBy',
        'AssignedTo',
        'DepartmentID',
    ];

    protected $casts = [
        'Deadline' => 'datetime',
    ];

    /**
     * Get the route key for implicit model binding.
     */
    public function getRouteKeyName()
    {
        return 'TaskID';
    }

    /**
     * Get the user who created this task.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'CreatedBy', 'UserID');
    }

    /**
     * Get the user this task is assigned to.
     */
    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'AssignedTo', 'UserID');
    }

    /**
     * Get the department this task belongs to.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'DepartmentID', 'DepartmentID');
    }

    /**
     * Get all comments on this task.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'TaskID', 'TaskID');
    }

    /**
     * Get all reports that include this task.
     */
    public function reports(): BelongsToMany
    {
        return $this->belongsToMany(
            Report::class,
            'report_tasks',
            'TaskID',
            'ReportID'
        );
    }
}
