<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRole
 */
class UserSkillEndorseNode extends Model
{
    protected $table = 'user_skill_endorse_nodes';

    public $timestamps = false;

    protected $fillable = [
        'user_skill_node_id',
        'user_id',
    ];

    protected $guarded = [];


}
