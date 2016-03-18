<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 */
class Contact extends Model
{
    protected $table = 'contacts';

    public $timestamps = true;

    protected $fillable = [
        'owner_id',
        'owner_role_id',
        'contact_owner_id',
        'contact_owner_role_id',
    ];

    protected $guarded = [];
}
