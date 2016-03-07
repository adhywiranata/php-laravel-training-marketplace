<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Video
 */
class Video extends Model
{
    protected $table = 'videos';

    public $timestamps = true;

    protected $fillable = [
        'owner_id',
        'giver_id',
        'testimony'
    ];

    protected $guarded = [];

        
}
