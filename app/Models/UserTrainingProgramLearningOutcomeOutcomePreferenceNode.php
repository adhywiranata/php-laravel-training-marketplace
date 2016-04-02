<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingProgramLearningOutcomeOutcomePreferenceNode
 */
class UserTrainingProgramLearningOutcomeOutcomePreferenceNode extends Model
{
    protected $table = 'user_training_program_learning_outcome_outcome_preference_nodes';

    public $timestamps = true;

    protected $fillable = [
        'user_training_program_learning_outcome_id',
        'outcome_preference_id'
    ];

    protected $guarded = [];


}
