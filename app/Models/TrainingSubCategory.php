<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingSubCategorie
 */
class TrainingSubCategorie extends Model
{
    protected $table = 'training_sub_categories';

    public $timestamps = true;

    protected $fillable = [
        'training_sub_category_name'
    ];

    protected $guarded = [];

        
}
