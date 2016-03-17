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
        'owner_role_id',
        'video_name',
        'video_path',
        'video_description',
        'video_type',
    ];

    protected $guarded = [];


}
