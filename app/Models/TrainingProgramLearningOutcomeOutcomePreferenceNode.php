<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingProgramLearningOutcomeOutcomePreferenceNode
 */
class TrainingProgramLearningOutcomeOutcomePreferenceNode extends Model
{
    protected $table = 'training_program_learning_outcome_outcome_preference_nodes';

    public $timestamps = true;

    protected $fillable = [
        'tplo_id',
        'op_id'
    ];

    protected $guarded = [];

        
}
