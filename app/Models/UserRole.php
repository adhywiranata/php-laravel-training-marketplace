<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRole
 */
class UserRole extends Model
{
    protected $table = 'user_roles';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'role_id'
    ];

    protected $guarded = [];

        
}
