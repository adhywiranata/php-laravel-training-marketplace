<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class IndustryJobFunctionNode
 */
class IndustryJobFunctionNode extends Model
{
    protected $table = 'industry_job_function_nodes';

    public $timestamps = true;

    protected $fillable = [
        'objective_id',
        'sub_objective_id'
    ];

    protected $guarded = [];

        
}
