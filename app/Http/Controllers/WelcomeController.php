<?php namespace App\Http\Controllers;

// CRUD Template
use App\Models\General;

// Use Email Class
use Illuminate\Support\Facades\Mail;
// Use Request Class
use Illuminate\Support\Facades\Request;
// Image Resize & Crop (Have to Install first Invertention Image)
use Intervention\Image\Facades\Image;
// User Request for validation
use App\Http\Requests\TrainingFormRequest;

// CALL SESSION
use Illuminate\Support\Facades\Session;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('welcome');
	}

	public function select_all_session()
	{
		Session::set('cobain','value123');
		//Session::get('cobain'); // get only array cobain

		//$request->session()->forget('key'); ||Session::forget('key'); // remove only a variable
		//$request->session()->flush(); ||Session::flush(); // remove all variable

		print_r(Session::get(null));
		exit();
	}

	public function select()
	{
		$select =
		[
			"table"			=> "user",
			"join"			=>
									[
										"role"	=>
														[
				  										"statement"	=> "role.role_id = user.role_id",
															"type"			=> "join",
														],
								 		"group"	=>
								 						[
															"statement"	=> "group.group_id = user.group_id",
															"type"			=> "left join",
														],
									],
			"condition"	=>
									[
										"0"		=>
													[
														"column"			=>  "user.role_id",
														"comparison"	=>	"=",
														"value"				=>	3,
													],
										"1"		=>
													[
														"column"			=>  "first_name",
														"comparison"	=>	"!=",
														"value"				=>	"",
													],
									],
			"limit"			=> "10",
			"offset"		=> "5",
			"orderBy"		=> "user_id",
			"orderType"	=> "ASC",
		];

		$users = General::Selects($select)->get();
		return view('')->withUsers($users);
		//End here
	}

	public function update()
	{
		$update =
		[
			"table"			=> "user",
			"timestamps"=> "true",
			"condition"	=>
									[
										"0"		=>
													[
														"column"			=>  "user.email",
														"comparison"	=>	"=",
														"value"				=>	"okta.bayuputra@gmail.com",
													],
									],
			"data"			=>
									[
										"role_id"					=> 1, // INT
										"first_name"			=> "Okta",
										"last_name"				=> "Bayu Putra",
										"password"				=> md5("Okta"),
									]
		];
		$users = General::Updates($update);
		//End here

	}

	public function create()
	{
		$create =
		[
			"table"			=> "user",
			"data"			=>
									[
										"role_id"					=> 1, // INT
										"first_name"			=> "Testing",
										"last_name"				=> "Insertion",
										"password"				=> md5("Testing"),
									]
		];
		$users = General::Creates($create);
		//End here
	}

	public function delete()
	{
		$delete =
		[
			"table"			=> "user",
			"condition"	=>
									[
										"0"		=>
													[
														"column"			=>  "user.user_id",
														"comparison"	=>	"=",
														"value"				=>	392,
													],
									]
		];
		$users = General::Deletes($delete);
		//End here
	}

	public function upload_photo()
	{
		if ( Request::hasFile('photo') )
		{
			if( Request::file('photo')->isvalid() ):

				$file  						= Request::file('photo');
				$file_name  			= Request::file('photo')->getClientOriginalName();

				$destinationPath = public_path() . '/images';
	    	Request::file('photo')->move($destinationPath, $file_name);
				//Resize & Crop | source image started from level public
				$img = Image::make('images/'.$file_name)->fit(200,200)->save('images/thumb/'.$file_name);
			else:
				$photo_error = Request::file('photo')->getErrorMessage();
				echo $photo_error;
			endif;
		}
		//end here
	}

	function calling_from_config()
	{
		echo Config('custom.about_us');
		//custom = file name; about_us = variable
	}

	function validation(TrainingFormRequest $request)
	{
		$input = $request;
		$input->input('title'); // echo column title

		if($errors->any()){ var_dump($errors); }
		if($errors->first('title')):
		 	echo $errors->first('title');
		endif;

		//
	}

	function request_class_example()
	{
		/*
		namespace App\Http\Requests;

		class TrainingFormRequest extends Request {

		  public function authorize()
		  {
		    return true;
		  }

		  public function rules()
		  {
		    return[
		      "title"										=> "required",
		      "training_provider"				=> "required",
		      "trainer"									=> "required",
		    ];
		  }

		}*/
		//end here
	}

	function send_email()
	{
		$data = array(
			"name"			=> "Speaqus",
			"tag_line"	=> "Search Public Training and Reliable Evaluation"
		);

		Mail::send('welcome', $data, function($message)
		{
    	$message->to('fandy_limardi@yahoo.com', 'Fandy Limardi')->from('cs.speaqus@gmail.com','Speaqus')->subject('Welcome!');
		});

		if( count(Mail::failures()) > 0 ):
		   echo "There was one or more failures. They were: <br />";

		   foreach(Mail::failures() as $error):
		       echo " - $error <br /	>";
		   endforeach;
		else:
		    echo "No errors, all sent successfully!";
		endif;

		//echo "Success";
	}

	function changeLanguage()
	{
		//\App::setlocale('en');
		echo trans('validation.accepted',['attribute' => 'Dayle']);
	}




}
