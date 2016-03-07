<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Provider
 */
class Provider extends Model
{
    protected $table = 'providers';

    public $timestamps = true;

    protected $fillable = [
        'provider_position_id',
        'email',
        'provider_name',
        'summary',
        'domicle_area',
        'service_area',
        'phone_number',
        'profile_picture',
        'training_method',
        'training_style',
        'mandays_fee',
        'slug',
        'is_verified'
    ];

    protected $guarded = [];

        
}
