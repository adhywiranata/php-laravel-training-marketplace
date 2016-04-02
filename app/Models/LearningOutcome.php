<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LearningOutcome
 */
class LearningOutcome extends Model
{
    protected $table = 'learning_outcomes';

    public $timestamps = true;

    protected $fillable = [
        'learning_outcome_name'
    ];

    protected $guarded = [];


}
