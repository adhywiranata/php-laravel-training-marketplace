<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRole
 */
class UserRoleNode extends Model
{
    protected $table = 'user_role_nodes';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'role_id',
    ];

    protected $guarded = [];


}
