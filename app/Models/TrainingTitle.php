<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingTitle
 */
class TrainingTitle extends Model
{
    protected $table = 'training_titles';

    public $timestamps = true;

    protected $fillable = [
        'title_EN',
        'title_ID'
    ];

    protected $guarded = [];

        
}
