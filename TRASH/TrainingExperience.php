<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingExperiencesTable
 */
class TrainingExperiencesTable extends Model
{
    protected $table = 'training_experiences';

    public $timestamps = true;

    protected $fillable = [
        'training_experience',
        'user_id',
        'provider_id',
        'corporate_id',
        'description',
        'start_date',
        'end_date'
    ];

    protected $guarded = [];

        
}
