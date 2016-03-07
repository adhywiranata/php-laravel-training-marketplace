<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JobSeniorityLevel
 */
class JobSeniorityLevel extends Model
{
    protected $table = 'job_seniority_levels';

    public $timestamps = true;

    protected $fillable = [
        'job_seniority_level_name'
    ];

    protected $guarded = [];

        
}
