<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingExperienceProgramNode
 */
class TrainingExperienceProgramNode extends Model
{
    protected $table = 'training_experience_program_nodes';

    public $timestamps = true;

    protected $fillable = [
        'training_experience_id',
        'training_program_id',
    ];

    protected $guarded = [];


}
