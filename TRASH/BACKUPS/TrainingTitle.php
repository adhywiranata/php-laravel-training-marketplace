<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingTitlesTable
 */
class TrainingTitlesTable extends Model
{
    protected $table = 'training_titles';

    public $timestamps = true;

    protected $fillable = [
        'training_title'
    ];

    protected $guarded = [];

        
}
