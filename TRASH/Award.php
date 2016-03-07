<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AwardsTable
 */
class AwardsTable extends Model
{
    protected $table = 'awards';

    public $timestamps = true;

    protected $fillable = [
        'owner_id',
        'title',
        'description',
        'publisher',
        'published_date'
    ];

    protected $guarded = [];

        
}
