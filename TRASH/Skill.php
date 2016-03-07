<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SkillsTable
 */
class SkillsTable extends Model
{
    protected $table = 'skills';

    public $timestamps = true;

    protected $fillable = [
        'skill'
    ];

    protected $guarded = [];

        
}
