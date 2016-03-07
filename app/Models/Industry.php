<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Industrie
 */
class Industrie extends Model
{
    protected $table = 'industries';

    public $timestamps = true;

    protected $fillable = [
        'industry_name'
    ];

    protected $guarded = [];

        
}
