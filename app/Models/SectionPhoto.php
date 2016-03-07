<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SectionPhoto
 */
class SectionPhoto extends Model
{
    protected $table = 'section_photos';

    public $timestamps = true;

    protected $fillable = [
        'section_id',
        'section_item_id',
        'photo_name',
        'photo_path',
        'photo_description'
    ];

    protected $guarded = [];

        
}
