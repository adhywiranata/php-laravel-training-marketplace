<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JobTitle
 */
class JobTitle extends Model
{
    protected $table = 'job_titles';

    public $timestamps = true;

    protected $fillable = [
        'job_title_name'
    ];

    protected $guarded = [];

        
}
