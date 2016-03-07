<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JobNode
 */
class JobNode extends Model
{
    protected $table = 'job_nodes';

    public $timestamps = true;

    protected $fillable = [
        'job_title_id',
        'job_function_id',
        'job_seniority_level_id'
    ];

    protected $guarded = [];

        
}
