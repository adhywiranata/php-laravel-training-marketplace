<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OutcomePreferencesTable
 */
class OutcomePreferencesTable extends Model
{
    protected $table = 'outcome_preferences';

    public $timestamps = true;

    protected $fillable = [
        'outcome_preference'
    ];

    protected $guarded = [];

        
}
