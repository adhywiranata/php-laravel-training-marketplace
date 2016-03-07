<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Section
 */
class Section extends Model
{
    protected $table = 'sections';

    public $timestamps = true;

    protected $fillable = [
        'section'
    ];

    protected $guarded = [];

        
}
