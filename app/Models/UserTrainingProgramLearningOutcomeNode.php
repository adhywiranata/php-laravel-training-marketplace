<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingProgramLearningOutcomeNode
 */
class UserTrainingProgramLearningOutcomeNode extends Model
{
    protected $table = 'user_training_program_learning_outcome_nodes';

    public $timestamps = true;

    protected $fillable = [
        'learning_outcome_id',
        'user_training_program_id'
    ];

    protected $guarded = [];


}
