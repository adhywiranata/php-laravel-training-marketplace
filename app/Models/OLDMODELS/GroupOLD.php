<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

	//
	public $timestamps  	= false;
	protected $table 			= 'group';
	protected $primaryKey = 'group_id';

	protected $fillable =
		[
			'group_type_id',
			'group_name',
			'group_email',
			'summary',
			'group_phone_number',
			'group_profile_picture',
			'group_cover_image',
			'group_slug',
		];

	function user()
	{
		return $this->hasMany('App\Models\User');
	}
}
