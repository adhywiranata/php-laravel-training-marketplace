<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CorporatesTable
 */
class CorporatesTable extends Model
{
    protected $table = 'corporates';

    public $timestamps = true;

    protected $fillable = [
        'corporate_name'
    ];

    protected $guarded = [];

        
}
