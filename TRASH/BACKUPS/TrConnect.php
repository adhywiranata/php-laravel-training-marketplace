<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_connect';

    protected $primaryKey = 'tr_connect_id';

	public $timestamps = false;

    protected $fillable = [
        'user_id',
        'connect_id',
        'refer_status',
        'role_friend'
    ];

    protected $guarded = [];

        
}