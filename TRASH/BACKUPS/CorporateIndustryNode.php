<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CorporateIndustryNodesTable
 */
class CorporateIndustryNodesTable extends Model
{
    protected $table = 'corporate_industry_nodes';

    public $timestamps = true;

    protected $fillable = [
        'corporate_id',
        'industry_id'
    ];

    protected $guarded = [];

        
}
