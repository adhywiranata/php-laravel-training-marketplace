<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	protected $primaryKey = 'user_id';


	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable =
		[
			'role_id',
			'group_id',
			'first_name',
			'last_name',
			'email',
			'password',
			'summary',
			'area',
			'address',
			'gender',
			'dob',
			'current_job_position',
			'job_level',
			'industry_type',
			'phone_number',
			'profile_image',
			'cover_image',
			'last_online',
			'key_code',
			'credit',
			'personality_test',
			'user_slug',
			'is_active',
			'is_verified_email',
		];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = ['password', 'remember_token'];
  	protected $hidden 		= ['password'];


	function role()
	{
		return $this->belongsTo('App\Models\Role');
		//parameter 2 => variable dari fillable valuenya 'role_id'
		//parameter 3 => variable dari database valuenya 'role_id'
	}

	function group()
	{
		return $this->belongsTo('App\Models\Group');
	}

}
