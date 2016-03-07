<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JobFunction
 */
class JobFunction extends Model
{
    protected $table = 'job_functions';

    public $timestamps = true;

    protected $fillable = [
        'job_function_name'
    ];

    protected $guarded = [];

        
}
