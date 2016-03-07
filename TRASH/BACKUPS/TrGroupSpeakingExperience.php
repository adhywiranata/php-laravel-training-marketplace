<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_group_speaking_experience';

    protected $primaryKey = 'tr_group_speaking_experience_id';

	public $timestamps = false;

    protected $fillable = [
        'group_id',
        'provider_id',
        'user_id',
        'group_speaking_experience_title',
        'group_speaking_experience_description',
        'group_speaking_video_link',
        'group_speaking_experience_date',
        'group_retention_status'
    ];

    protected $guarded = [];

        
}