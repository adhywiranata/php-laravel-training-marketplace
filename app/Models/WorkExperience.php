<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WorkExperience
 */
class WorkExperience extends Model
{
    protected $table = 'work_experiences';

    public $timestamps = true;

    protected $fillable = [
        'owner_id',
        'owner_role_id',
        'corporate_id',
        'title',
        'position',
        'description',
        'start_date',
        'end_date'
    ];

    protected $guarded = [];


}
