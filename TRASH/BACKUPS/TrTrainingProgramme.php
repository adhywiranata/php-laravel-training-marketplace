<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_training_programme';

    protected $primaryKey = 'tr_training_programme_id';

	public $timestamps = false;

    protected $fillable = [
        'user_id',
        'training_programme_title'
    ];

    protected $guarded = [];

        
}