<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TploOpNodesTable
 */
class TploOpNodesTable extends Model
{
    protected $table = 'tplo_op_nodes';

    public $timestamps = true;

    protected $fillable = [
        'tplo_id',
        'op_id'
    ];

    protected $guarded = [];

        
}
