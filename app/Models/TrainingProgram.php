<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingProgramme
 */
class TrainingProgram extends Model
{
    protected $table = 'training_program';

    public $timestamps = true;

    protected $fillable = [
        'training_program_name_id'
    ];

    protected $guarded = [];


}
