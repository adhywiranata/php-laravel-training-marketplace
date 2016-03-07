<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

	//
	public $timestamps  	= false;
	protected $table 			= 'role';
	protected $primaryKey = 'role_id';

	protected $fillable =
		[
			'role_name',
		];

	function user()
	{
		return $this->hasMany('App\Models\User');
	}

}
