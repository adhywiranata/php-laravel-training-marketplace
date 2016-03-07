<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingProgrammesTable
 */
class TrainingProgrammesTable extends Model
{
    protected $table = 'training_programmes';

    public $timestamps = true;

    protected $fillable = [
        'programme'
    ];

    protected $guarded = [];

        
}
