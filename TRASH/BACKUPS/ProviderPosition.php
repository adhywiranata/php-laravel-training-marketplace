<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProviderPositionsTable
 */
class ProviderPositionsTable extends Model
{
    protected $table = 'provider_positions';

    public $timestamps = true;

    protected $fillable = [
        'position_name'
    ];

    protected $guarded = [];

        
}
