<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingProgramLearningOutcomeNode
 */
class TrainingProgramLearningOutcomeNode extends Model
{
    protected $table = 'training_program_learning_outcome_nodes';

    public $timestamps = true;

    protected $fillable = [
        'learning_outcome_id',
        'training_program_id'
    ];

    protected $guarded = [];

        
}
