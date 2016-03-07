<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_group_award';

    protected $primaryKey = 'tr_group_award_id';

	public $timestamps = false;

    protected $fillable = [
        'group_id',
        'group_award_title',
        'group_award_description',
        'group_publisher_name',
        'group_award_date'
    ];

    protected $guarded = [];

        
}