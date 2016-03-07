<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingSubCategoriesTable
 */
class TrainingSubCategoriesTable extends Model
{
    protected $table = 'training_sub_categories';

    public $timestamps = true;

    protected $fillable = [
        'training_category_id',
        'training_sub_category'
    ];

    protected $guarded = [];

        
}
