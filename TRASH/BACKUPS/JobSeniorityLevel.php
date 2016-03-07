<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JobSeniorityLevelsTable
 */
class JobSeniorityLevelsTable extends Model
{
    protected $table = 'job_seniority_levels';

    public $timestamps = true;

    protected $fillable = [
        'job_seniority_level'
    ];

    protected $guarded = [];

        
}
