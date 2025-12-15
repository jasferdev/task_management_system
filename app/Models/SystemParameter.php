<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemParameter extends Model
{
    protected $table = 'system_parameters';
    protected $primaryKey = 'ParameterID';
    public $timestamps = true;

    protected $fillable = [
        'ParameterType',
        'ParameterValue',
    ];

    /**
     * Get the route key for implicit model binding.
     */
    public function getRouteKeyName()
    {
        return 'ParameterID';
    }
}
