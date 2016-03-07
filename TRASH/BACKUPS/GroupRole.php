<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'group_role';

    protected $primaryKey = 'group_role_id';

	public $timestamps = false;

    protected $fillable = [
        'group_role_name'
    ];

    protected $guarded = [];

        
}