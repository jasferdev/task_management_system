<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';
    protected $primaryKey = 'DepartmentID';
    public $timestamps = true;

    protected $fillable = [
        'DepartmentName',
    ];

    /**
     * Get the route key for implicit model binding.
     */
    public function getRouteKeyName()
    {
        return 'DepartmentID';
    }

    /**
     * Get all users in this department.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'DepartmentID', 'DepartmentID');
    }

    /**
     * Get all tasks in this department.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'DepartmentID', 'DepartmentID');
    }
}
