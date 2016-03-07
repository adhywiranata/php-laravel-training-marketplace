<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingSubObjectivesTable
 */
class TrainingSubObjectivesTable extends Model
{
    protected $table = 'training_sub_objectives';

    public $timestamps = true;

    protected $fillable = [
        'training_sub_objective'
    ];

    protected $guarded = [];

        
}
