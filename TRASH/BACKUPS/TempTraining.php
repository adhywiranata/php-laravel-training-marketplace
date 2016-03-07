<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'temp_training';

    protected $primaryKey = 'temp_training_id';

	public $timestamps = false;

    protected $fillable = [
        'title',
        'training_provider',
        'trainer',
        'start_date',
        'end_date',
        'training_area',
        'method',
        'venue',
        'pic_name',
        'material',
        'delivery',
        'facility',
        'total_participants',
        'participants_department',
        'language',
        'average_post_test_score',
        'team_lead',
        'competencies'
    ];

    protected $guarded = [];

        
}