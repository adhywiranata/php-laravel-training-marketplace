<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_group_certification';

    protected $primaryKey = 'tr_group_certification_id';

	public $timestamps = false;

    protected $fillable = [
        'group_id',
        'group_certification_title',
        'group_certification_description',
        'group_publisher_name',
        'group_certification_date'
    ];

    protected $guarded = [];

        
}