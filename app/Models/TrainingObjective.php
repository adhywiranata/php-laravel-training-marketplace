<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingObjective
 */
class TrainingObjective extends Model
{
    protected $table = 'training_objectives';

    public $timestamps = true;

    protected $fillable = [
        'training_objective'
    ];

    protected $guarded = [];

        
}
