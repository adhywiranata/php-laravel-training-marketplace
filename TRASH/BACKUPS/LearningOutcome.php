<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LearningOutcomesTable
 */
class LearningOutcomesTable extends Model
{
    protected $table = 'learning_outcomes';

    public $timestamps = true;

    protected $fillable = [
        'learning_outcome'
    ];

    protected $guarded = [];

        
}
