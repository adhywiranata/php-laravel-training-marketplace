<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserTrainingProgramNode
 */
class UserTrainingProgramNode extends Model
{
    protected $table = 'user_training_program_nodes';

    public $timestamps = true;

    protected $fillable = [
        'owner_id',
        'owner_role_id',
        'training_program_id',
        'is_certification_included'
    ];

    protected $guarded = [];


}
