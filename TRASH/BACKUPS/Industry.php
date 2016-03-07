<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class IndustriesTable
 */
class IndustriesTable extends Model
{
    protected $table = 'industries';

    public $timestamps = true;

    protected $fillable = [
        'industry'
    ];

    protected $guarded = [];

        
}
