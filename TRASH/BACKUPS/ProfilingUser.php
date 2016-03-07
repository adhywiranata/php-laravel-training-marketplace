<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'profiling_user';

    protected $primaryKey = 'profiling_user';

	public $timestamps = false;

    protected $fillable = [
        'user_id',
        'subscribe',
        'sign_up',
        'pasif_refer',
        'active_refer',
        'company',
        'provider',
        'trainer',
        'friend',
        'more_company',
        'more_provider',
        'more_trainer',
        'more_friend',
        'status'
    ];

    protected $guarded = [];

        
}