<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_featured';

    protected $primaryKey = 'tr_featured_id';

	public $timestamps = false;

    protected $fillable = [
        'user_id',
        'group_id'
    ];

    protected $guarded = [];

        
}