<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'expertise';

    protected $primaryKey = 'expertise_id';

	public $timestamps = false;

    protected $fillable = [
        'expertise_name'
    ];

    protected $guarded = [];

        
}