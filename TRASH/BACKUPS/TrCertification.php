<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_certification';

    protected $primaryKey = 'tr_certification_id';

	public $timestamps = false;

    protected $fillable = [
        'user_id',
        'certification_title',
        'certification_description',
        'publisher_name',
        'certification_date'
    ];

    protected $guarded = [];

        
}