<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class IndustrySubCategoryNode
 */
class IndustrySubCategoryNode extends Model
{
    protected $table = 'industry_sub_category_nodes';

    public $timestamps = true;

    protected $fillable = [
        'industry_id',
        'sub_category_id'
    ];

    protected $guarded = [];

        
}
