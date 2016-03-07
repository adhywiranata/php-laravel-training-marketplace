<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_group_endorse';

    protected $primaryKey = 'tr_group_endorse_id';

	public $timestamps = false;

    protected $fillable = [
        'user_id',
        'tr_group_expertise_id',
        'is_verified'
    ];

    protected $guarded = [];

        
}