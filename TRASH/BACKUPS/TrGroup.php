<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_group';

    protected $primaryKey = 'tr_group_id';

	public $timestamps = false;

    protected $fillable = [
        'user_id',
        'group_id',
        'group_role_id'
    ];

    protected $guarded = [];

        
}