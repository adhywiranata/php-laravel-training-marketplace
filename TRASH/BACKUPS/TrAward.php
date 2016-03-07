<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_award';

    protected $primaryKey = 'tr_award_id';

	public $timestamps = false;

    protected $fillable = [
        'user_id',
        'award_title',
        'award_description',
        'publisher_name',
        'award_date'
    ];

    protected $guarded = [];

        
}