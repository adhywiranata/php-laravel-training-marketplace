<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_award_expertise';

    protected $primaryKey = 'tr_award_expertise_id';

	public $timestamps = false;

    protected $fillable = [
        'tr_award_id',
        'expertise_id'
    ];

    protected $guarded = [];

        
}