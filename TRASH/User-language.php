<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User-languagesTable
 */
class User-languagesTable extends Model
{
    protected $table = 'user-languages';

    public $timestamps = true;

    protected $fillable = [
        'language_id',
        'user_id'
    ];

    protected $guarded = [];

        
}
