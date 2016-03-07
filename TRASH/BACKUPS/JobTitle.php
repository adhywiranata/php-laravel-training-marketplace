<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JobTitlesTable
 */
class JobTitlesTable extends Model
{
    protected $table = 'job_titles';

    public $timestamps = true;

    protected $fillable = [
        'job_title'
    ];

    protected $guarded = [];

        
}
