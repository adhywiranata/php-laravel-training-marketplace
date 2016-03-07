<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_group_expertise';

    protected $primaryKey = 'tr_group_expertise_id';

	public $timestamps = false;

    protected $fillable = [
        'group_id',
        'expertise_id',
        'is_deleted'
    ];

    protected $guarded = [];

        
}