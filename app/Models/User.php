<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'UserID';
    public $timestamps = true;

    protected $fillable = [
        'Name',
        'Email',
        'Role',
        'Status',
        'DepartmentID',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the route key for implicit model binding.
     */
    public function getRouteKeyName()
    {
        return 'UserID';
    }

    /**
     * Get the department this user belongs to.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'DepartmentID', 'DepartmentID');
    }

    /**
     * Get all tasks created by this user.
     */
    public function createdTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'CreatedBy', 'UserID');
    }

    /**
     * Get all tasks assigned to this user.
     */
    public function assignedTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'AssignedTo', 'UserID');
    }

    /**
     * Get all comments made by this user.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'UserID', 'UserID');
    }

    /**
     * Get all reports created by this user.
     */
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'CreatedBy', 'UserID');
    }
}
