<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingTitleSubCategoryNodesTable
 */
class TrainingTitleSubCategoryNodesTable extends Model
{
    protected $table = 'training_title_sub_category_nodes';

    public $timestamps = true;

    protected $fillable = [
        'training_title_id',
        'sub_category_id'
    ];

    protected $guarded = [];

        
}
