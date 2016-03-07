<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SubCategoryTrainingTitleNodesTable
 */
class SubCategoryTrainingTitleNodesTable extends Model
{
    protected $table = 'sub_category_training_title_nodes';

    public $timestamps = true;

    protected $fillable = [
        'training_title_id',
        'sub_category_id'
    ];

    protected $guarded = [];

        
}
