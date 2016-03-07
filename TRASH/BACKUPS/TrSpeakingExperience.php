<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_speaking_experience';

    protected $primaryKey = 'tr_speaking_experience_id';

	public $timestamps = false;

    protected $fillable = [
        'user_id',
        'group_id',
        'speaking_experience_title',
        'speaking_experience_description',
        'video_link',
        'speaking_experience_date',
        'retention_status'
    ];

    protected $guarded = [];

        
}