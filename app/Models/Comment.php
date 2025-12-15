<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'CommentID';
    public $timestamps = true;

    protected $fillable = [
        'TaskID',
        'UserID',
        'CommentText',
        'DatePosted',
    ];

    protected $casts = [
        'DatePosted' => 'datetime',
    ];

    /**
     * Get the route key for implicit model binding.
     */
    public function getRouteKeyName()
    {
        return 'CommentID';
    }

    /**
     * Get the task this comment belongs to.
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'TaskID', 'TaskID');
    }

    /**
     * Get the user who made this comment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }
}
