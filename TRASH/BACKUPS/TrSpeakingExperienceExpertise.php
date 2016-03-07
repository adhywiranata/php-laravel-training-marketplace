<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_speaking_experience_expertise';

    protected $primaryKey = 'tr_speaking_experience_expertise_id';

	public $timestamps = false;

    protected $fillable = [
        'tr_speaking_experience_id',
        'expertise_id'
    ];

    protected $guarded = [];

        
}