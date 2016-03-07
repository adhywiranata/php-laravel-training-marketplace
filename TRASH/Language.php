<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LanguagesTable
 */
class LanguagesTable extends Model
{
    protected $table = 'languages';

    public $timestamps = true;

    protected $fillable = [
        'language'
    ];

    protected $guarded = [];

        
}
