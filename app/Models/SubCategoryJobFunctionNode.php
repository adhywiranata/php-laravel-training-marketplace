<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SubCategoryJobFunctionNode
 */
class SubCategoryJobFunctionNode extends Model
{
    protected $table = 'sub_category_job_function_nodes';

    public $timestamps = true;

    protected $fillable = [
        'job_function_id',
        'sub_category_id'
    ];

    protected $guarded = [];

        
}
