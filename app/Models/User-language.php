<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User-language
 */
class User-language extends Model
{
    protected $table = 'user-languages';

    public $timestamps = true;

    protected $fillable = [
        'language_id',
        'user_id'
    ];

    protected $guarded = [];

        
}
