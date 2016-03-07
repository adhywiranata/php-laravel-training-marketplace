<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'temp_evaluation';

    protected $primaryKey = 'temp_evaluation_id';

	public $timestamps = false;

    protected $fillable = [
        'audience_name',
        'job_title',
        'job_level',
        'job_function',
        'material',
        'material_description',
        'delivery',
        'delivery_description',
        'facility',
        'facility_description',
        'Post Test Score'
    ];

    protected $guarded = [];

        
}