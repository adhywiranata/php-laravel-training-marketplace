<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_client_list';

    protected $primaryKey = 'tr_client_list_id';

	public $timestamps = false;

    protected $fillable = [
        'user_id',
        'group_id'
    ];

    protected $guarded = [];

        
}