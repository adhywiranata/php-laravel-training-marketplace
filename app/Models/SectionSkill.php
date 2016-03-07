<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SectionSkill
 */
class SectionSkill extends Model
{
    protected $table = 'section_skills';

    public $timestamps = true;

    protected $fillable = [
        'section_id',
        'skill_id'
    ];

    protected $guarded = [];

        
}
