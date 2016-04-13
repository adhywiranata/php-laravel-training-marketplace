<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingExperience
 */
class TrainingExperience extends Model
{
    protected $table = 'training_experiences';

    public $timestamps = true;

    protected $fillable = [
        'training_experience',
        'training_type',
        'owner_id',
        'owner_role_id',
        'provider_id',
        'corporate_id',
        'description',
        'start_date',
        'end_date'
    ];

    protected $guarded = [];


}
