<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SectionsTable
 */
class SectionsTable extends Model
{
    protected $table = 'sections';

    public $timestamps = true;

    protected $fillable = [
        'section'
    ];

    protected $guarded = [];

        
}
