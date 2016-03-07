<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OutcomePreference
 */
class OutcomePreference extends Model
{
    protected $table = 'outcome_preferences';

    public $timestamps = true;

    protected $fillable = [
        'outcome_preference'
    ];

    protected $guarded = [];

        
}
