<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Award
 */
class Award extends Model
{
    protected $table = 'awards';

    public $timestamps = true;

    protected $fillable = [
        'owner_id',
        'owner_role_id',
        'title',
        'description',
        'publisher',
        'published_date'
    ];

    protected $guarded = [];


}
