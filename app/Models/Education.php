<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Education
 */
class Education extends Model
{
    protected $table = 'educations';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'school',
        'start_date',
        'end_date'
    ];

    protected $guarded = [];

        
}
