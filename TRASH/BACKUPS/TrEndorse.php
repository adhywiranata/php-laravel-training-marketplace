<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_endorse';

    protected $primaryKey = 'tr_endorse_id';

	public $timestamps = false;

    protected $fillable = [
        'endorse_id',
        'tr_user_expertise_id',
        'is_verified'
    ];

    protected $guarded = [];

        
}