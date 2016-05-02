<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User-language
 */
class UserLanguageNode extends Model
{
    protected $table = 'user_language_nodes';

    public $timestamps = true;

    protected $fillable = [
        'language_id',
        'owner_id',
        'owner_role_id',
    ];

    protected $guarded = [];


}
