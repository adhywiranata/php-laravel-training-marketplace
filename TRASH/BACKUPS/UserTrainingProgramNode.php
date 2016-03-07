<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserTrainingProgramNodesTable
 */
class UserTrainingProgramNodesTable extends Model
{
    protected $table = 'user_training_program_nodes';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'training_program_id'
    ];

    protected $guarded = [];

        
}
