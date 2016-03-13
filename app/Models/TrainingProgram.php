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
        'program'
    ];

    protected $guarded = [];


}
