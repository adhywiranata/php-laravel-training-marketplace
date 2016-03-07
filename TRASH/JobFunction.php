<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JobFunctionsTable
 */
class JobFunctionsTable extends Model
{
    protected $table = 'job_functions';

    public $timestamps = true;

    protected $fillable = [
        'job_function'
    ];

    protected $guarded = [];

        
}
