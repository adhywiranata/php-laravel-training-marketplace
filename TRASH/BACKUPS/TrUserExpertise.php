<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_user_expertise';

    protected $primaryKey = 'tr_user_expertise_id';

	public $timestamps = false;

    protected $fillable = [
        'user_id',
        'expertise_id',
        'is_deleted'
    ];

    protected $guarded = [];

        
}