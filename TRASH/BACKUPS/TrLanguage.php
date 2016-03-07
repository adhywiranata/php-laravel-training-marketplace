<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_language';

    protected $primaryKey = 'tr_language_id';

	public $timestamps = false;

    protected $fillable = [
        'user_id',
        'language_code'
    ];

    protected $guarded = [];

        
}