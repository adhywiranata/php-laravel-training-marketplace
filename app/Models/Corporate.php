<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Corporate
 */
class Corporate extends Model
{
    protected $table = 'corporates';

    public $timestamps = true;

    protected $fillable = [
        'corporate_name',
        'corporate_profile_picture',
        'corporate_description'
    ];

    protected $guarded = [];

        
}
