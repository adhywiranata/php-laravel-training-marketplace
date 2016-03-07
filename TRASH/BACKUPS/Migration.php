<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MigrationsTable
 */
class MigrationsTable extends Model
{
    protected $table = 'migrations';

    public $timestamps = false;

    protected $fillable = [
        'migration',
        'batch'
    ];

    protected $guarded = [];

        
}
