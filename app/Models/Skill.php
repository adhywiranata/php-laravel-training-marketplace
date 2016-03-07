<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Skill
 */
class Skill extends Model
{
    protected $table = 'skills';

    public $timestamps = true;

    protected $fillable = [
        'skill_name'
    ];

    protected $guarded = [];

        
}
