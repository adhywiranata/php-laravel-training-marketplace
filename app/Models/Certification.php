<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Certification
 */
class Certification extends Model
{
    protected $table = 'certifications';

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
