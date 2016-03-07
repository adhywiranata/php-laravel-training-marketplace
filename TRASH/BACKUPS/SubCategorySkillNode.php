<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SubCategorySkillNodesTable
 */
class SubCategorySkillNodesTable extends Model
{
    protected $table = 'sub_category_skill_nodes';

    public $timestamps = true;

    protected $fillable = [
        'skill_id',
        'sub_category_id'
    ];

    protected $guarded = [];

        
}
