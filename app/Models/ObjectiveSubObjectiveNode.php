<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ObjectiveSubObjectiveNode
 */
class ObjectiveSubObjectiveNode extends Model
{
    protected $table = 'objective_sub_objective_nodes';

    public $timestamps = true;

    protected $fillable = [
        'objective_id',
        'sub_objective_id'
    ];

    protected $guarded = [];

        
}
