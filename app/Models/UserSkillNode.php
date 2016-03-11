<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRole
 */
class UserSkillNode extends Model
{
    protected $table = 'user_skill_nodes';

    public $timestamps = true;

    protected $fillable = [
        'owner_id',
        'owner_role_id',
        'skill_id',
    ];

    protected $guarded = [];


}
