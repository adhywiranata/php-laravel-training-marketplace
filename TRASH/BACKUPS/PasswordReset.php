<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PasswordResetsTable
 */
class PasswordResetsTable extends Model
{
    protected $table = 'password_resets';

    public $timestamps = true;

    protected $fillable = [
        'email',
        'token'
    ];

    protected $guarded = [];

        
}
