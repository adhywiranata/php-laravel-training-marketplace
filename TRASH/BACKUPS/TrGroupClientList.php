<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_group_client_list';

    protected $primaryKey = 'tr_group_client_list_id';

	public $timestamps = false;

    protected $fillable = [
        'group_id',
        'client_id'
    ];

    protected $guarded = [];

        
}