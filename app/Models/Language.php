<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Language
 */
class Language extends Model
{
    protected $table = 'languages';

    public $timestamps = true;

    protected $fillable = [
        'language'
    ];

    protected $guarded = [];

        
}
