<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Report extends Model
{
    protected $table = 'reports';
    protected $primaryKey = 'ReportID';
    public $timestamps = true;

    protected $fillable = [
        'Title',
        'CreatedBy',
        'DateGenerated',
    ];

    protected $casts = [
        'DateGenerated' => 'datetime',
    ];

    /**
     * Get the route key for implicit model binding.
     */
    public function getRouteKeyName()
    {
        return 'ReportID';
    }

    /**
     * Get the user who created this report.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'CreatedBy', 'UserID');
    }

    /**
     * Get all tasks included in this report.
     */
    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(
            Task::class,
            'report_tasks',
            'ReportID',
            'TaskID'
        );
    }
}
