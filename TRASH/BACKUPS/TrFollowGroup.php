<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_follow_group';

    protected $primaryKey = 'tr_follow_group_id';

	public $timestamps = false;

    protected $fillable = [
        'user_id',
        'group_id',
        'registration_follow_date'
    ];

    protected $guarded = [];

        
}