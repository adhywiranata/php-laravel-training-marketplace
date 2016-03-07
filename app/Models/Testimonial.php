<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Testimonial
 */
class Testimonial extends Model
{
    protected $table = 'testimonials';

    public $timestamps = true;

    protected $fillable = [
        'owner_id',
        'giver_id',
        'testimony'
    ];

    protected $guarded = [];

        
}
