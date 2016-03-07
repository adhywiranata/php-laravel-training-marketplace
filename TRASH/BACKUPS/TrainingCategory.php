<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingCategoriesTable
 */
class TrainingCategoriesTable extends Model
{
    protected $table = 'training_categories';

    public $timestamps = true;

    protected $fillable = [
        'training_category'
    ];

    protected $guarded = [];

        
}
