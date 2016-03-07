<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingCategorie
 */
class TrainingCategorie extends Model
{
    protected $table = 'training_categories';

    public $timestamps = true;

    protected $fillable = [
        'training_category'
    ];

    protected $guarded = [];

        
}
