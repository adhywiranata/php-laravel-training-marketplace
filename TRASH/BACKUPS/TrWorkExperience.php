<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_work_experience';

    protected $primaryKey = 'tr_work_experience_id';

	public $timestamps = false;

    protected $fillable = [
        'user_id',
        'group_id',
        'work_experience_title',
        'work_experience_position',
        'work_experience_description',
        'work_experience_start_date',
        'work_experience_end_date'
    ];

    protected $guarded = [];

        
}