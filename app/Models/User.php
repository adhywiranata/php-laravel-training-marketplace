<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * Class User
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword;

    protected $table = 'users';

    public $timestamps = true;

    protected $fillable = [
        'corporate_id',
        'corporate_name',
        'email',
        'password',
        'first_name',
        'last_name',
        'summary',
        'domicle_area',
        'service_area',
        'address',
        'phone_number',
        'gender',
        'dob',
        'profile_picture',
        'job_title',
        'job_function',
        'job_seniority_level',
        'training_method',
        'training_style',
        'mandays_fee',
        'slug',
        'last_online',
        'is_verified',
        'is_tour',
        'remember_token'
    ];

    protected $guarded = [];

    /**
  	 * The attributes excluded from the model's JSON form.
  	 *
  	 * @var array
  	 */
  	//protected $hidden = ['password', 'remember_token'];
    protected $hidden 		= ['password'];


    public function trainerSkills()
    {
        return $this->hasMany('App\Models\UserSkillNode', 'owner_id')
            ->join('skills', function ($join) {
                $join->on('skills.id', '=', 'user_skill_nodes.skill_id')
                    ->where('owner_role_id', '=', 2);
            });
    }


}
