<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Request;
use Redirect;
use Socialize;
use App\Models\User;
use App\Models\UserRoleNode;

class AuthController extends Controller {


	public function __construct()
	{

	}

	/*
	|--------------------------------------------------------------------------
	| Function for User Login & Registration
	|--------------------------------------------------------------------------
	*/
	public function index()
	{
		$data = array(
			'email'		=> Request::input('email'),
			'password'	=> md5(Request::input('password'))
		);

		$regis = User::where('email', $data['email'])->first();

		if($regis)
		{
			//User has registered
			$user = User::where($data)->first();
			if($user)
			{
				//Login Success, Set User Data to Auth
				Auth::login($user);
				return Redirect::to('/');
			}
			else
			{
				//Invalid Password
				return Redirect::to('/')
					->withError('Invalid Email or Password');
			}
		}
		else
		{
			//Hasn't Registered
			$user 									= new User();
			$user->email 						= $data['email'];
			$user->password 				= $data['password'];
			$user->is_verified 			= 1;
			$user->profile_picture 	= 'default.png';
			$user->save();


			$update = [
				'slug' 			=> $user->id,
			];
			User::find($user->id)->update($update);


			$create_node = [
	 		 'user_id' => $user->id,
	 		 'role_id' => 1, // BASIC ROLE
	 	 	];
	 	 $userRoleNode = UserRoleNode::create($create_node);


			Auth::login($user);
			return Redirect::to('/');
		}
	}


	/*
	|--------------------------------------------------------------------------
	| Function for Logout
	|--------------------------------------------------------------------------
	*/
	public function logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}




	/**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    public function redirectToGoogle()
    {
        return Socialize::with('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialize::with('google')->user();
        } catch (Exception $e) {
            return Redirect::to('/');
        }

        //$authUser = $this->findOrCreateUser($user);

        /*Auth::login($authUser, true);

        return Redirect::to('/');*/
        echo $user->getId();
		echo $user->getNickname();
		echo $user->getName();
		echo $user->getEmail();
		echo $user->getAvatar();
    }



    /**
     * Redirect the user to the LinkedIn authentication page.
     *
     * @return Response
     */
    public function redirectToLinkedin()
    {
        return Socialize::with('linkedin')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleLinkedinCallback()
    {
        try {
            $user = Socialize::with('linkedin')->user();
        } catch (Exception $e) {
            return Redirect::to('/');
        }

        //$authUser = $this->findOrCreateUser($user);

        /*Auth::login($authUser, true);

        return Redirect::to('/');*/
        echo $user->getId();
		echo $user->getNickname();
		echo $user->getName();
		echo $user->getEmail();
		echo $user->getAvatar();
    }
}
