<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CertificationsTable
 */
class CertificationsTable extends Model
{
    protected $table = 'certifications';

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
