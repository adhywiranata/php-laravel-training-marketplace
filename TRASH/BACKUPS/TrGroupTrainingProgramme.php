<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_group_training_programme';

    protected $primaryKey = 'tr_group_training_programme_id';

	public $timestamps = false;

    protected $fillable = [
        'group_id',
        'user_id',
        'group_training_programme_title'
    ];

    protected $guarded = [];

        
}