<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportTask extends Model
{
    use HasFactory;

    protected $table = 'report_tasks';

    protected $fillable = [
        'report_id',
        'task_id',
    ];

    public function report()
{
    return $this->belongsTo(Report::class);
}

public function task()
{
    return $this->belongsTo(Task::class);
}

}