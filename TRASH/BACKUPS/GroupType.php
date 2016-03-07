<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'group_type';

    protected $primaryKey = 'group_type_id';

	public $timestamps = false;

    protected $fillable = [
        'group_type_name'
    ];

    protected $guarded = [];

        
}