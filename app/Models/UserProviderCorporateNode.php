<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRole
 */
class UserProviderCorporateNode extends Model
{
    protected $table = 'user_provider_corporate_nodes';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'group_id',
        'group_role_id',
        'group_position_id'
    ];

    protected $guarded = [];


}
