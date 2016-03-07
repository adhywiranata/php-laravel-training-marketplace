<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'tr_review';

    protected $primaryKey = 'tr_review_id';

	public $timestamps = false;

    protected $fillable = [
        'reviewer_id',
        'user_id',
        'material_score',
        'delivery_score',
        'facility_score',
        'material_description',
        'delivery_description',
        'facility_description',
        'status',
        'is_hidden',
        'is_verified',
        'registration_date'
    ];

    protected $guarded = [];

        
}