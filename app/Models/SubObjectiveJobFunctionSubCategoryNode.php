<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SubObjectiveJobFunctionSubCategoryNode
 */
class SubObjectiveJobFunctionSubCategoryNode extends Model
{
    protected $table = 'sub_objective_job_function_sub_category_nodes';

    public $timestamps = true;

    protected $fillable = [
        'sub_objective_id',
        'job_function_id',
        'sub_category_id'
    ];

    protected $guarded = [];

        
}
