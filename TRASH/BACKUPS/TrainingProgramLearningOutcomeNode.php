<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingProgramLearningOutcomeNodesTable
 */
class TrainingProgramLearningOutcomeNodesTable extends Model
{
    protected $table = 'training_program_learning_outcome_nodes';

    public $timestamps = true;

    protected $fillable = [
        'learning_outcome_id',
        'training_program_id'
    ];

    protected $guarded = [];

        
}
