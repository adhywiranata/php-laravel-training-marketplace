<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

//Corporates
use App\Models\Corporate as Corporate;

//Users
use App\Models\User as User;

//Training Experience
use App\Models\TrainingExperience as TrainingExperience;
use App\Models\TrainingExperienceProgramNode as TrainingExperienceProgramNode;

use App\Models\WorkExperience as WorkExperience;

//Skills
use App\Models\Skill as Skill;
use App\Models\SectionSkill as SectionSkill;
use App\Models\UserSkillNode as UserSkillNode;
use App\Models\UserSkillEndorseNode as UserSkillEndorseNode;

//Photo
use App\Models\SectionPhoto as SectionPhoto;

//Training Program
use App\Models\TrainingProgram as TrainingProgram;
use App\Models\UserTrainingProgramNode as UserTrainingProgramNode;
use App\Models\UserTrainingProgramLearningOutcomeNode as UserTrainingProgramLearningOutcomeNode;
use App\Models\UserTrainingProgramLearningOutcomeOutcomePreferenceNode as UserTrainingProgramLearningOutcomeOutcomePreferenceNode;

//Certification
use App\Models\Certification as Certification;

//Award
use App\Models\Award as Award;

//Video
use App\Models\Video as Video;

//Testimonial
use App\Models\Testimonial as Testimonial;

//Learning Outcome
use App\Models\LearningOutcome as LearningOutcome;

//Request
use App\Http\Requests\trainingExperienceRequest;
use App\Http\Requests\workExperienceRequest;
use App\Http\Requests\trainingProgramRequest;
use App\Http\Requests\certificationRequest;
use App\Http\Requests\awardRequest;
use App\Http\Requests\skillRequest;
use App\Http\Requests\videoRequest;
use App\Http\Requests\testimonialRequest;
use App\Http\Requests\SignUpLandingRequest;


use App\Models\UserRoleNode as UserRoleNode;
use App\Models\UserProviderCorporateNode as UserProviderCorporateNode;

use Auth;

use App\Models\JobTitle as JobTitle;
use App\Models\JobSeniorityLevel as JobSeniorityLevel;
use App\Models\JobFunction as JobFunction;
use App\Models\JobNode as JobNode;
use App\Models\Provider as Provider;

use Intervention\Image\Facades\Image;


//Feature Tracking
use App\Models\FeatureTracking as FeatureTracking;

class GeneralController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::check())
		{
			return redirect('/users');
		}

		$page_role = '';
		return view('landing')->with('page_role',$page_role);
	}

	public function provider()
	{
		$page_role = '_provider';
		return view('landing')->with('page_role',$page_role);
	}

	public function freelancer()
	{
		$page_role = '_freelancer';
		return view('landing')->with('page_role',$page_role);
	}

	public function loginLanding()
	{
		return view('landing.login');
	}

	public function signupLanding($role)
	{
		//role 1 = basic , role 2 = provider
		return view('landing.signup')->with('role',$role);
	}

	public function createUserFromLanding(SignUpLandingRequest $request,$role)
	{

		// roles: basic, freelance-trainer, training-provider
		if($role == 'basic')
		{
			$role_code = 1;
		}
		if($role == 'freelance-trainer')
		{
			$role_code = 2;
		}
		if($role == 'training-provider')
		{
			$role_code = 3;
		}
		//BASIC REGISTRATION
		$input = $request->all();
		//CHECK IF CORPORATE DOES NOT EXIST,CREATE A NEW ONE
		$corp_exist = Corporate::where('corporate_name',$input['corporate_name'])
										 ->count();
		if($corp_exist == 0)
		{
			Corporate::create(['corporate_name' => $input['corporate_name']]);
		}

		//CHECK IF JOB TITLE DOES NOT EXIST,CREATE A NEW ONE
		$title_exist = JobTitle::where('job_title_name',$input['job_title'])
										 ->count();

		if($title_exist == 0)
		{
			JobTitle::create(['job_title_name' => $input['job_title']]);
		}

		$job_title_id = JobTitle::where('job_title_name',$input['job_title'])
										 ->first()->id;

		//Fetch the right JobNode or create new
		$job_node_exist = JobNode::where('job_title_id',$job_title_id)->count();

		$job_seniority_level = '';
		$job_function = '';

		if($job_node_exist == 0 && $input['job_title'] != '')
		{
			$job_node = JobNode::where('job_title_id',$job_title_id)->first();
			$job_seniority_level = JobSeniorityLevel::where('id',$job_node->job_seniority_level_id)
																 ->first()->job_seniority_level_name;
			$job_function = JobFunction::where('id',$job_node->job_function_id)
												 ->first()->job_function_name;
		}

	 if ( $request->hasFile('profile_picture') )
	 {
		 if( $request->file('profile_picture')->isvalid() ):

			 $file  					= $request->file('profile_picture');
			 $file_name  			= $request->file('profile_picture')->getClientOriginalName();

			 $destinationPath = public_path() . '/images/users';
			 $request->file('profile_picture')->move($destinationPath, $file_name);
			 //Resize & Crop | source image started from level public
			 $img = Image::make('images/users/'.$file_name)->fit(200,200)->save('images/users/thumb/'.$file_name);
		 else:
			 $photo_error = $request->file('profile_picture')->getErrorMessage();
			 echo $photo_error;
		 endif;
	 }

	 $create = [

		 'email'								=> $input['email'],
		 'password'							=> md5($input['password']),
		 'first_name' 					=> $input['first_name'],
		 'last_name' 						=> $input['last_name'],

		 'corporate_name' 			=> $input['corporate_name'],
		 'job_title' 						=> $input['job_title'],

		 'job_seniority_level' 	=> $job_seniority_level,
		 'job_function' 				=> $job_function,

		 'email' 								=> $input['email'],
		 'summary' 							=> $input['summary'],
		 //'domicle_area' 				=> $input['domicle_area'],
		 'service_area' 				=> $input['service_area'],

		 //'gender' 							=> $input['gender'],
		 //'dob' 									=> $input['dob'],

		 //'training_method' 			=> $input['training_method'],
		 //'training_style' 			=> $input['training_style'],
		 'profile_picture' 			=> (isset($file_name))?$file_name:'default.png',
	 ];

	 $user = User::create($create);

	 $update = [
		 'slug' 				=> $user->id,
		 'is_verified' 	=> 1
	 ];
	 User::where('id',$user->id)->update($update);


	 //CREATE USERS NODE
	 if($role_code == 3):
		 $create_node = [
			'user_id' => $user->id,
			'role_id' => 1,
		 ];
	 else:
		 $create_node = [
			 'user_id' => $user->id,
			 'role_id' => $role_code
		 ];
	 endif;
		 $userRoleNode = UserRoleNode::create($create_node);

	 //CHECK IF role is a Training Provider ($role_code = 3)
	 if($role_code == 3)
	 {
		 if ( $request->hasFile('provider_profile_picture') )
		 {
			 if( $request->file('provider_profile_picture')->isvalid() ):

				 $file_provider  					= $request->file('provider_profile_picture');
				 $file_name_provider  		= $request->file('provider_profile_picture')->getClientOriginalName();

				 $destinationPathProvider = public_path() . '/images/users';
				 $request->file('provider_profile_picture')->move($destinationPathProvider, $file_name_provider);
				 //Resize & Crop | source image started from level public
				 $img = Image::make('images/users/'.$file_name_provider)->fit(200,200)->save('images/users/thumb/'.$file_name_provider);
			 else:
				 $photo_error = $request->file('provider_profile_picture')->getErrorMessage();
				 echo $photo_error;
			 endif;
		 }
		 else
		 {
		 		 $file_name_provider = 'default.png';
		 }
		 $create_provider = [
			 'provider_name' 		=> $input['provider_name'],
			 'phone_number' 		=> $input['provider_phone'],
		 	 'email' 						=> $input['provider_email'],
		 	 'profile_picture' 	=> $file_name_provider,
		 ];
		 $provider = Provider::create($create_provider);

		 $update_provider = [
			 'slug'					=> $provider->id,
			 'is_verified' 	=> 1,
		 ];
		 
		 Provider::where('id',$provider->id)->update($update_provider);

		 //CREATE PROVIDER NODE
		 $create_provider_node = [
			 'user_id' => $provider->id,
			 'role_id' => 3,
		 ];
		 $providerRoleNode = UserRoleNode::create($create_provider_node);

		 $create_node = [
			 'user_id' 						=> $user->id,
			 'group_id' 					=> $provider->id,
			 'group_role_id' 			=> 1,
			 'group_position_id' 	=> 1
		 ];
		 UserProviderCorporateNode::create($create_node);

	 } //ENDIF for Role 3 (provider) checking


	 return redirect('login');

	}
	/**
	* Display user evaluation page
	*
	* @return Response
	*/
	public function getEvaluation()
	{
		return view('profile.audience-evaluation-page');
	}

	/**
	* Display user training experience form page
	*
	* @return Response
	*/
	public function addTrainingExperience()
	{
		return view('profile.forms.add-training-experience');
	}

	public function createTrainingExperience(trainingExperienceRequest $request)
	{
		$section_id = 1; //Section id for Training Experience

		$input = $request->all();

		$session_owner_id = Session::get('owner_id');
		$session_owner_role_id = Session::get('owner_role_id');

		//CHECK IF CORPORATE DOES NOT EXIST,CREATE A NEW ONE
		$corporate = Corporate::where('corporate_name',$input['company'])->first();
		if(count($corporate) == 0)
		{
			$corporate = Corporate::create([ 'corporate_name' => $input['company'] ]);
		}

		//CHECK IF TRAINING PROGRAM DOES NOT EXIST,CREATE A NEW ONE
		$training_program = TrainingProgram::where('training_program_name_id',$input['training_program'])->first();
		if(count($training_program) == 0)
		{
			$training_program_in = TrainingProgram::create([ 'training_program_name_id' => $input['training_program'] ]);
			$tp_id = $training_program_in->id;
		}
		else
		{
			$tp_id = $training_program->id;
		}

		$insert_training_experience = [
			'owner_id' 						=> $session_owner_id,
			'owner_role_id' 			=> $session_owner_role_id,
			'provider_id' 				=> 1,
			'corporate_id' 				=> $corporate->id,
			'training_experience' => $input['training_experience'],
			'description' 				=> $input['description'],
			'start_date' 					=> $input['start_date'],
			'end_date' 						=> $input['end_date'],
		];

		$training_experience = TrainingExperience::create($insert_training_experience);

		$new_training_experience_id = $training_experience->id;
		//CREATE TRAINING EXPERIENCE - TRAINING PROGRAM NODE
		$tep_node = [
			'training_experience_id' => $new_training_experience_id,
			'training_program_id' => $tp_id
		];

		$training_experience_program_node = TrainingExperienceProgramNode::create($tep_node);

		//CHECK IF SKILL DOES NOT EXISTS
		$skills = explode('|||',$input['skill']);
		for($i=0;$i<count($skills);$i++)
		{
			$skill_name = $skills[$i];
			if($skill_name != '')
			{
				$skill = Skill::where('skill_name',$skill_name)->first();
				if(count($skill) == 0)
				{
					$skill = Skill::create([ 'skill_name' => $skill_name ]);
				}

				$node_insert = [
					'section_id' => $section_id,
					'section_item_id' => $new_training_experience_id,
					'skill_id' => $skill->id
				];

				SectionSkill::create($node_insert);
			}
		}

		$files = [];
		//$count_files = 0;

		//Section Photos Upload
		if ( $request->hasFile('training_photos') ):

			$files 				= $request->file('training_photos');
			//$count_files 	= count($files);

			foreach($files as $file):

				if( $file->isvalid() ):

					$file_name  			= $file->getClientOriginalName();
					$destinationPath 	= public_path() . '/images/section_photos';
					$file->move($destinationPath, $file_name);
					//Resize & Crop | source image started from level public
					$img = Image::make('images/section_photos/'.$file_name)->fit(200,200)->save('images/section_photos/'.$file_name);

				else:

					$photo_error = $file->getErrorMessage();
					echo $photo_error;

				endif;
			endforeach;
		endif;

		//Section photo create nodes
		foreach($files as $file):


			$node_insert = [
				'section_id' => $section_id,
				'section_item_id' => $new_training_experience_id,
				'photo_path' => $file->getClientOriginalName()
			];

			SectionPhoto::create($node_insert);
		endforeach;

		return redirect('dashboard#training-experiences');
	}

	public function editTrainingExperience($id)
	{
		$training_experience =	DB::table('training_experience_program_nodes')
									  				 ->select('*','training_experiences.id AS training_experience_id')
														 ->join('training_experiences','training_experience_program_nodes.training_experience_id','=','training_experiences.id')
														 ->join('training_program','training_experience_program_nodes.training_program_id','=','training_program.id')
														 ->join('providers','training_experiences.provider_id','=','providers.id')
														 ->join('corporates','training_experiences.corporate_id','=','corporates.id')
														 ->where('training_experiences.id', '=', $id)
														 ->first();

		//SKILL TRAINING EXPERIENCE
		$training_experience_expertises =	DB::table('section_skills')
																			 ->join('skills','section_skills.skill_id','=','skills.id')
																			 ->where('section_skills.section_id', '=', 1)
																			 ->where('section_skills.section_item_id', '=', $training_experience->training_experience_id)
																			 ->get();

		$training_experience_expertises_data = array();
		foreach($training_experience_expertises as $training_experience_expertise):
			$training_experience_expertise_data = array(
				"expertise_name"		=>	$training_experience_expertise->skill_name,
			);
			array_push($training_experience_expertises_data,$training_experience_expertise_data);
		endforeach;


		//PHOTO TRAINING EXPERIENCE
		$training_experience_photos = DB::table('section_photos')
																			 ->where('section_photos.section_id', '=', 1)
																			 ->where('section_photos.section_item_id', '=', $training_experience->training_experience_id)
																			 ->get();

		$training_experience_photos_data = array();
		foreach($training_experience_photos as $training_experience_photo):
			$training_experience_photo_data = array(
				"photo_name"					=>	$training_experience_photo->photo_name,
				"photo_path"					=>	$training_experience_photo->photo_path,
				"photo_description"		=>	$training_experience_photo->photo_description,
			);
			array_push($training_experience_photos_data,$training_experience_photo_data);
		endforeach;

		//VIDEO TRAINING EXPERIENCE
		$training_experience_videos = DB::table('section_videos')
																 ->where('section_videos.section_id', '=', 1)
																 ->where('section_videos.section_item_id', '=', $training_experience->training_experience_id)
																 ->where('section_videos.video_type', '=', "youtube")
																 ->get();

		$training_experience_videos_data = array();
		foreach($training_experience_videos as $training_experience_video):
			$training_experience_video_data = array(
				"video_name"					=>	$training_experience_video->video_name,
				"video_path"					=>	$training_experience_video->video_path,
				"video_description"		=>	$training_experience_video->video_description,
			);
			array_push($training_experience_videos_data,$training_experience_video_data);
		endforeach;

		//SUMMARY TRAINING EXPERIENCES VARIABLE
		$training_experience_data  = array(
			"speaking_experience_id"					  	=>		$training_experience->training_experience_id,
			"speaking_experience_title"					  =>		$training_experience->training_experience,
			"speaking_experience_description"			=>		$training_experience->description,
			"speaking_experience_start_date"		  =>		$training_experience->start_date,
			"speaking_experience_end_date"				=>		$training_experience->end_date,
			"company_profile_picture"					  	=>		$training_experience->corporate_profile_picture,
			"company_name"											  =>		$training_experience->corporate_name,
			"provider_profile_picture"					  =>		$training_experience->profile_picture,
			"provider_name"											  =>		$training_experience->provider_name,
			"speaking_experience_expertises"			=>		$training_experience_expertises_data,
			"speaking_experience_photos"					=>		$training_experience_photos_data,
			"speaking_experience_videos"					=>		$training_experience_videos_data,
			"training_programme_title"						=>		$training_experience->training_program_name_id,
		);



		$training_experience_data = json_decode(json_encode($training_experience_data), FALSE);

		return view('profile.forms.add-training-experience')
								->with('training_experience',$training_experience_data);
	}

	public function updateTrainingExperience($id , trainingExperienceRequest $request)
	{
		$section_id = 1; //Section id for Training Experience

		$input = $request->all();

		$session_owner_id = Session::get('owner_id');
		$session_owner_role_id = Session::get('owner_role_id');

		//CHECK IF CORPORATE DOES NOT EXIST,CREATE A NEW ONE
		$corporate = Corporate::where('corporate_name',$input['company'])->first();
		if(count($corporate) == 0)
		{
			$corporate = Corporate::create([ 'corporate_name' => $input['company'] ]);
		}

		//CHECK IF TRAINING PROGRAM DOES NOT EXIST,CREATE A NEW ONE
		$training_program = TrainingProgram::where('training_program_name_id',$input['training_program'])->first();
		if(count($training_program) == 0)
		{
			$training_program_in = TrainingProgram::create([ 'training_program_name_id' => $input['training_program'] ]);
			$tp_id = $training_program_in->id;
		}
		else
		{
			$tp_id = $training_program->id;
		}


		$update_training_experience = [
			'owner_id' 						=> $session_owner_id,
			'owner_role_id' 			=> $session_owner_role_id,
			'provider_id' 				=> 1,
			'corporate_id' 				=> $corporate->id,
			'training_experience' => $input['training_experience'],
			'description' 				=> $input['description'],
			'start_date' 					=> $input['start_date'],
			'end_date' 						=> $input['end_date'],
		];
		TrainingExperience::find($id)->update($update_training_experience);
		//CREATE TRAINING EXPERIENCE - TRAINING PROGRAM NODE


		//VALIDATION TRAINING EXPERIENCE AND PROGRAM NODE
		$training_experience_program_node = DB::table('training_experience_program_nodes')
																			 ->where('training_experience_program_nodes.training_experience_id', '=', $id)
																			 ->where('training_experience_program_nodes.training_program_id', '=', $tp_id)
																			 ->first();

		if(count($training_experience_program_node) == 0):

				TrainingExperienceProgramNode::where('training_experience_id','=',$id)->delete();
				$tep_node = [
					'training_experience_id' 	=> $id,
					'training_program_id' 		=> $tp_id
				];
				$training_experience_program_node = TrainingExperienceProgramNode::create($tep_node);

		endif;

		//CHECK IF SKILL DOES NOT EXISTS
		$skills = explode('|||',$input['skill']);
		for($i=0;$i<count($skills);$i++)
		{
			$skill_name = $skills[$i];
			if($skill_name != '')
			{
				$skill = Skill::where('skill_name',$skill_name)->first();
				if(count($skill) == 0)
				{
					$skill = Skill::create([ 'skill_name' => $skill_name ]);
				}


				$section_skill_node = DB::table('section_skills')
															 ->where('section_skills.section_id', '=', $section_id)
															 ->where('section_skills.section_item_id', '=', $id)
															 ->where('section_skills.skill_id', '=', $skill->id)
															 ->first();

				if(count($section_skill_node) == 0):
					$node_insert = [
						'section_id' 			=> $section_id,
						'section_item_id' => $id,
						'skill_id' 				=> $skill->id
					];
					SectionSkill::create($node_insert);
				endif;

			}
		}

		$files = [];
		//$count_files = 0;

		//Section Photos Upload
		if ( $request->hasFile('training_photos') ):

			$files 				= $request->file('training_photos');
			//$count_files 	= count($files);

			foreach($files as $file):

				if( $file->isvalid() ):

					$file_name  			= $file->getClientOriginalName();
					$destinationPath 	= public_path() . '/images/section_photos';
					$file->move($destinationPath, $file_name);
					//Resize & Crop | source image started from level public
					$img = Image::make('images/section_photos/'.$file_name)->fit(200,200)->save('images/section_photos/'.$file_name);

				else:

					$photo_error = $file->getErrorMessage();
					echo $photo_error;

				endif;
			endforeach;
		endif;

		//Section photo create nodes
		foreach($files as $file):


			$section_photo_node = DB::table('section_photos')
														 ->where('section_photos.section_id', '=', $section_id)
														 ->where('section_photos.section_item_id', '=', $id)
														 ->where('section_photos.photo_path', '=', $file->getClientOriginalName())
														 ->first();
      if(count($section_photo_node) == 0):

			$node_insert = [
				'section_id' 				=> $section_id,
				'section_item_id' 	=> $id,
				'photo_path' 				=> $file->getClientOriginalName()
			];
			SectionPhoto::create($node_insert);

			endif;

		endforeach;

		return redirect('dashboard#training-experiences');
	}

	public function deleteTrainingExperience($id)
	{
		TrainingExperience::find($id)->delete();
		TrainingExperienceProgramNode::where('training_experience_id','=',$id)->delete();
		SectionSkill::where('section_item_id','=',$id)->delete();
		SectionPhoto::where('section_item_id','=',$id)->delete();

		return redirect('dashboard#training-experiences');
	}

	/**
	* Display user work experience form page
	*
	* @return Response
	*/
	public function addWorkExperience()
	{
		return view('profile.forms.add-work-experience');
	}

	public function createWorkExperience(workExperienceRequest $request)
	{
		$input = $request->all();
		$session_owner_id = Session::get('owner_id');
		$session_owner_role_id = Session::get('owner_role_id');

		//CHECK IF CORPORATE DOES NOT EXIST,CREATE A NEW ONE
		$corporate = Corporate::where('corporate_name',$input['company'])->first();
		if(count($corporate) == 0)
		{
			$corporate = Corporate::create([ 'corporate_name' => $input['company'] ]);
		}


		$insert_work_experience = [
			'owner_id' 						=> $session_owner_id,
			'owner_role_id' 			=> $session_owner_role_id,
			'corporate_id' 				=> $corporate->id,
			'title' 							=> $input['title'],
			'description' 				=> $input['description'],
			'start_date' 					=> $input['start_date_year']."-".$input['start_date_month']."-".$input['start_date_day'],
			'end_date' 						=> $input['end_date_year']."-".$input['end_date_month']."-".$input['end_date_day'],
		];
		WorkExperience::create($insert_work_experience);

		return redirect('dashboard#work-experiences');
	}

	public function editWorkExperience($id)
	{
		$work_experience	=		DB::table('work_experiences')
												  ->select('*','work_experiences.id AS work_experience_id')
												  ->join('corporates','work_experiences.corporate_id','=','corporates.id')
												  ->where('work_experiences.id', '=', $id)
												  ->first();

		return view('profile.forms.add-work-experience')
								->with('work_experience',$work_experience);
	}

	public function updateWorkExperience($id , workExperienceRequest $request)
	{
		$input = $request->all();

		//CHECK IF CORPORATE DOES NOT EXIST,CREATE A NEW ONE
		$corporate = Corporate::where('corporate_name',$input['company'])->first();
		if(count($corporate) == 0)
		{
			$corporate = Corporate::create([ 'corporate_name' => $input['company'] ]);
		}

		$update_work_experience = [
			'corporate_id' 				=> $corporate->id,
			'title' 							=> $input['title'],
			'description' 				=> $input['description'],
			'start_date' 					=> $input['start_date_year']."-".$input['start_date_month']."-".$input['start_date_day'],
			'end_date' 						=> $input['end_date_year']."-".$input['end_date_month']."-".$input['end_date_day'],
		];
		WorkExperience::find($id)->update($update_work_experience);


		return redirect('dashboard#work-experiences');
	}

	public function deleteWorkExperience($id)
	{
		WorkExperience::find($id)->delete();
		SectionSkill::where('section_item_id','=',$id)->delete();


		return redirect('dashboard#work-experiences');
	}

	/**
	* Display user training experience form page
	*
	* @return Response
	*/
	public function addCertification()
	{
		return view('profile.forms.add-certification');
	}

	public function createCertification(certificationRequest $request)
	{
		$section_id = 7; //Section id for Certification

		$input = $request->all();
		$session_owner_id = Session::get('owner_id');
		$session_owner_role_id = Session::get('owner_role_id');

		$insert_certification = [
			'owner_id' 						=> $session_owner_id,
			'owner_role_id' 			=> $session_owner_role_id,
			'title' 							=> $input['title'],
			'publisher' 					=> $input['publisher'],
			'description' 				=> $input['description'],
			'published_date' 			=> $input['published_date'],
		];

		$certification = Certification::create($insert_certification);

		$new_certification_id = $certification->id;

		//CHECK IF SKILL DOES NOT EXISTS
		$skills = explode('|||',$input['skill']);
		for($i=0;$i<count($skills);$i++)
		{
			$skill_name = $skills[$i];
			if($skill_name != '')
			{
				$skill = Skill::where('skill_name',$skill_name)->first();
				if(count($skill) == 0)
				{
					$skill = Skill::create([ 'skill_name' => $skill_name ]);
				}

				$node_insert = [
					'section_id' 			=> $section_id,
					'section_item_id' => $new_certification_id,
					'skill_id' 				=> $skill->id
				];

				SectionSkill::create($node_insert);
			}
		}

		$files = [];
		//$count_files = 0;

		//Section Photos Upload
		if ( $request->hasFile('certification_photos') ):

			$files 				= $request->file('certification_photos');
			//$count_files 	= count($files);

			foreach($files as $file):

				if( $file->isvalid() ):

					$file_name  			= $file->getClientOriginalName();
					$destinationPath 	= public_path() . '/images/section_photos';
					$file->move($destinationPath, $file_name);
					//Resize & Crop | source image started from level public
					$img = Image::make('images/section_photos/'.$file_name)->fit(200,200)->save('images/section_photos/'.$file_name);

				else:

					$photo_error = $file->getErrorMessage();
					echo $photo_error;

				endif;
			endforeach;
		endif;

		//Section photo create nodes
		foreach($files as $file):

			$node_insert = [
				'section_id' 			=> $section_id,
				'section_item_id' => $new_certification_id,
				'photo_path' 			=> $file->getClientOriginalName()
			];

			SectionPhoto::create($node_insert);
		endforeach;

		return redirect('dashboard#certifications');
	}

	public function editCertification($id)
	{
		$certification =	DB::table('certifications')
											->where('certifications.id', '=', $id)
											->first();

		//SKILL CERTIFICATION
		$certification_expertises =	DB::table('section_skills')
															 ->join('skills','section_skills.skill_id','=','skills.id')
															 ->where('section_skills.section_id', '=', 7)
															 ->where('section_skills.section_item_id', '=', $certification->id)
															 ->get();

		$certification_expertises_data = array();
		foreach($certification_expertises as $certification_expertise):
			$certification_expertise_data = array(
				"expertise_name"		=>	$certification_expertise->skill_name,
			);
			array_push($certification_expertises_data,$certification_expertise_data);
		endforeach;

		//PHOTO CERTIFICATION
		$certification_photos = DB::table('section_photos')
													 ->where('section_photos.section_id', '=', 7)
													 ->where('section_photos.section_item_id', '=', $certification->id)
													 ->get();

		$certification_photos_data = array();
		foreach($certification_photos as $certification_photo):
			$certification_photo_data = array(
				"photo_name"					=>	$certification_photo->photo_name,
				"photo_path"					=>	$certification_photo->photo_path,
				"photo_description"		=>	$certification_photo->photo_description,
			);
			array_push($certification_photos_data,$certification_photo_data);
		endforeach;

		//VIDEO CERTIFICATION
		$certification_videos = DB::table('section_videos')
																 ->where('section_videos.section_id', '=', 7)
																 ->where('section_videos.section_item_id', '=', $certification->id)
																 ->get();

		$certification_videos_data = array();
		foreach($certification_videos as $certification_video):
			$certification_video_data = array(
				"video_name"					=>	$certification_video->video_name,
				"video_path"					=>	$certification_video->video_path,
				"video_description"		=>	$certification_video->video_description,
			);
			array_push($certification_videos_data,$certification_video_data);
		endforeach;

		//SUMMARY CERTIFICATION VARIABLE
		$certification_data  = array(
			"id"					  								=>		$certification->id,
			"title"					  							=>		$certification->title,
			"description"										=>		$certification->description,
			"publisher"											=>		$certification->publisher,
			"published_date"					  		=>		$certification->published_date,
			"certification_expertises"			=>		$certification_expertises_data,
			"certification_photos"					=>		$certification_photos_data,
			"certification_videos"					=>		$certification_videos_data
		);

		$certification_data = json_decode(json_encode($certification_data), FALSE);

		return view('profile.forms.add-certification')
								->with('certification',$certification_data);
	}

	public function updateCertification(certificationRequest $request, $id)
	{
		$section_id = 7; //Section id for Certification

		$input = $request->all();
		$session_owner_id = Session::get('owner_id');
		$session_owner_role_id = Session::get('owner_role_id');

		$update_certification = [
			'owner_id' 						=> $session_owner_id,
			'owner_role_id' 			=> $session_owner_role_id,
			'title' 							=> $input['title'],
			'publisher' 					=> $input['publisher'],
			'description' 				=> $input['description'],
			'published_date' 			=> $input['published_date'],
		];

		$certification = Certification::where('id',$id)->update($update_certification);

		$new_certification_id = Certification::where('id',$id);

		//CHECK IF SKILL DOES NOT EXISTS
		$skills = explode('|||',$input['skill']);
		for($i=0;$i<count($skills);$i++)
		{
			$skill_name = $skills[$i];
			if($skill_name != '')
			{
				$skill = Skill::where('skill_name',$skill_name)->first();
				if(count($skill) == 0)
				{
					$skill = Skill::create([ 'skill_name' => $skill_name ]);
				}


				$section_skill_node = DB::table('section_skills')
															 ->where('section_skills.section_id', '=', $section_id)
															 ->where('section_skills.section_item_id', '=', $id)
															 ->where('section_skills.skill_id', '=', $skill->id)
															 ->first();

				if(count($section_skill_node) == 0):
					$node_insert = [
						'section_id' 			=> $section_id,
						'section_item_id' => $id,
						'skill_id' 				=> $skill->id
					];
					SectionSkill::create($node_insert);
				endif;



			}
		}

		$files = [];
		//$count_files = 0;

		//Section Photos Upload
		if ( $request->hasFile('certification_photos') ):

			$files 				= $request->file('certification_photos');
			//$count_files 	= count($files);

			foreach($files as $file):

				if( $file->isvalid() ):

					$file_name  			= $file->getClientOriginalName();
					$destinationPath 	= public_path() . '/images/section_photos';
					$file->move($destinationPath, $file_name);
					//Resize & Crop | source image started from level public
					$img = Image::make('images/section_photos/'.$file_name)->fit(200,200)->save('images/section_photos/'.$file_name);

				else:

					$photo_error = $file->getErrorMessage();
					echo $photo_error;

				endif;
			endforeach;
		endif;


		//Section photo create nodes
		foreach($files as $file):


			$section_photo_node = DB::table('section_photos')
														 ->where('section_photos.section_id', '=', $section_id)
														 ->where('section_photos.section_item_id', '=', $id)
														 ->where('section_photos.photo_path', '=', $file->getClientOriginalName())
														 ->first();
      if(count($section_photo_node) == 0):

			$node_insert = [
				'section_id' 				=> $section_id,
				'section_item_id' 	=> $id,
				'photo_path' 				=> $file->getClientOriginalName()
			];
			SectionPhoto::create($node_insert);

			endif;

		endforeach;

		return redirect('dashboard#certifications');
	}

	public function deleteCertification($id)
	{
		Certification::find($id)->delete();
		SectionSkill::where('section_item_id','=',$id)->delete();
		SectionPhoto::where('section_item_id','=',$id)->delete();

		return redirect('dashboard#certifications');
	}

	/**
	* Display user award form page
	*
	* @return Response
	*/
	public function addAward()
	{
		return view('profile.forms.add-award');
	}

	public function createAward(awardRequest $request)
	{
		$section_id = 8; //Section id for Certification

		$input = $request->all();
		$session_owner_id = Session::get('owner_id');
		$session_owner_role_id = Session::get('owner_role_id');

		$insert_award = [
			'owner_id' 						=> $session_owner_id,
			'owner_role_id' 			=> $session_owner_role_id,
			'title' 							=> $input['title'],
			'description' 				=> $input['description'],
			'published_date' 			=> $input['published_date'],
		];

		$award = Award::create($insert_award);

		$new_award_id = $award->id;

		//CHECK IF SKILL DOES NOT EXISTS
		$skills = explode('|||',$input['skill']);
		for($i=0;$i<count($skills);$i++)
		{
			$skill_name = $skills[$i];
			if($skill_name != '')
			{
				$skill = Skill::where('skill_name',$skill_name)->first();
				if(count($skill) == 0)
				{
					$skill = Skill::create([ 'skill_name' => $skill_name ]);
				}

				$node_insert = [
					'section_id' => $section_id,
					'section_item_id' => $new_award_id,
					'skill_id' => $skill->id
				];

				SectionSkill::create($node_insert);
			}
		}

		$files = [];
		//$count_files = 0;

		//Section Photos Upload
		if ( $request->hasFile('award_photos') ):

		  $files 				= $request->file('award_photos');
		  //$count_files 	= count($files);

		  foreach($files as $file):

		    if( $file->isvalid() ):

		      $file_name  			= $file->getClientOriginalName();
		      $destinationPath 	= public_path() . '/images/section_photos';
		      $file->move($destinationPath, $file_name);
		      //Resize & Crop | source image started from level public
		      $img = Image::make('images/section_photos/'.$file_name)->fit(200,200)->save('images/section_photos/'.$file_name);

		    else:

		      $photo_error = $file->getErrorMessage();
		      echo $photo_error;

		    endif;
		  endforeach;
		endif;

		//Section photo create nodes
		foreach($files as $file):

		  $node_insert = [
		    'section_id' 			=> $section_id,
		    'section_item_id' => $new_award_id,
		    'photo_path' 			=> $file->getClientOriginalName()
		  ];

		  SectionPhoto::create($node_insert);
		endforeach;

		return redirect('dashboard#awards');
	}

	public function editAward($id)
	{
		$award =	DB::table('awards')
              ->where('awards.id', '=', $id)
              ->first();

		//SKILL award
		$award_expertises =	DB::table('section_skills')
                       ->join('skills','section_skills.skill_id','=','skills.id')
                       ->where('section_skills.section_id', '=', 8)
                       ->where('section_skills.section_item_id', '=', $award->id)
                       ->get();

		$award_expertises_data = array();
		foreach($award_expertises as $award_expertise):
		  $award_expertise_data = array(
		    "expertise_name"		=>	$award_expertise->skill_name,
		  );
		  array_push($award_expertises_data,$award_expertise_data);
		endforeach;

		//PHOTO award
		$award_photos = DB::table('section_photos')
                   ->where('section_photos.section_id', '=', 8)
                   ->where('section_photos.section_item_id', '=', $award->id)
                   ->get();

		$award_photos_data = array();
		foreach($award_photos as $award_photo):
		  $award_photo_data = array(
		    "photo_name"					=>	$award_photo->photo_name,
		    "photo_path"					=>	$award_photo->photo_path,
		    "photo_description"		=>	$award_photo->photo_description,
		  );
		  array_push($award_photos_data,$award_photo_data);
		endforeach;

		//VIDEO award
		$award_videos = DB::table('section_videos')
                   ->where('section_videos.section_id', '=', 8)
                   ->where('section_videos.section_item_id', '=', $award->id)
                   ->get();

		$award_videos_data = array();
		foreach($award_videos as $award_video):
		  $award_video_data = array(
		    "video_name"					=>	$award_video->video_name,
		    "video_path"					=>	$award_video->video_path,
		    "video_description"		=>	$award_video->video_description,
		  );
		  array_push($award_videos_data,$award_video_data);
		endforeach;

		//SUMMARY award VARIABLE
		$award_data  = array(
		  "id"					  								=>		$award->id,
		  "title"					  							=>		$award->title,
		  "description"										=>		$award->description,
		  "publisher"											=>		$award->publisher,
		  "published_date"					  		=>		$award->published_date,
		  "award_expertises"							=>		$award_expertises_data,
		  "award_photos"									=>		$award_photos_data,
		  "award_videos"									=>		$award_videos_data
		);

		$award_data = json_decode(json_encode($award_data), FALSE);

		return view('profile.forms.add-award')
								->with('award',$award_data);
	}

	public function updateAward(awardRequest $request, $id)
	{
		$section_id = 8; //Section id for Award

		$input = $request->all();
		$session_owner_id = Session::get('owner_id');
		$session_owner_role_id = Session::get('owner_role_id');

		$update_award = [
			'owner_id' 						=> $session_owner_id,
			'owner_role_id' 			=> $session_owner_role_id,
			'title' 							=> $input['title'],
			'description' 				=> $input['description'],
			'published_date' 			=> $input['published_date'],
		];

		$award = Award::where('id',$id)->update($update_award);

		$new_award_id = Award::where('id',$id);

		//CHECK IF SKILL DOES NOT EXISTS
		$skills = explode('|||',$input['skill']);
		for($i=0;$i<count($skills);$i++)
		{
		  $skill_name = $skills[$i];
		  if($skill_name != '')
		  {
		    $skill = Skill::where('skill_name',$skill_name)->first();
		    if(count($skill) == 0)
		    {
		      $skill = Skill::create([ 'skill_name' => $skill_name ]);
		    }


		    $section_skill_node = DB::table('section_skills')
		                           ->where('section_skills.section_id', '=', $section_id)
		                           ->where('section_skills.section_item_id', '=', $id)
		                           ->where('section_skills.skill_id', '=', $skill->id)
		                           ->first();

		    if(count($section_skill_node) == 0):
		      $node_insert = [
		        'section_id' 			=> $section_id,
		        'section_item_id' => $id,
		        'skill_id' 				=> $skill->id
		      ];
		      SectionSkill::create($node_insert);
		    endif;

		  }
		}

		$files = [];
		//$count_files = 0;

		//Section Photos Upload
		if ( $request->hasFile('award_photos') ):

		  $files 				= $request->file('award_photos');
		  //$count_files 	= count($files);

		  foreach($files as $file):

		    if( $file->isvalid() ):

		      $file_name  			= $file->getClientOriginalName();
		      $destinationPath 	= public_path() . '/images/section_photos';
		      $file->move($destinationPath, $file_name);
		      //Resize & Crop | source image started from level public
		      $img = Image::make('images/section_photos/'.$file_name)->fit(200,200)->save('images/section_photos/'.$file_name);

		    else:

		      $photo_error = $file->getErrorMessage();
		      echo $photo_error;

		    endif;
		  endforeach;
		endif;


		//Section photo create nodes
		foreach($files as $file):

		  $section_photo_node = DB::table('section_photos')
		                         ->where('section_photos.section_id', '=', $section_id)
		                         ->where('section_photos.section_item_id', '=', $id)
		                         ->where('section_photos.photo_path', '=', $file->getClientOriginalName())
		                         ->first();
		  if(count($section_photo_node) == 0):

		  $node_insert = [
		    'section_id' 				=> $section_id,
		    'section_item_id' 	=> $id,
		    'photo_path' 				=> $file->getClientOriginalName()
		  ];
		  SectionPhoto::create($node_insert);

		  endif;

		endforeach;

		return redirect('dashboard#awards');
	}

	public function deleteAward($id)
	{
		Award::find($id)->delete();

		return redirect('dashboard#awards');
	}

	/**
	* Display user training experience form page
	*
	* @return Response
	*/
	public function addProgram()
	{
		return view('profile.forms.add-program');
	}

	public function createProgram(TrainingProgramRequest $request)
	{

		$section_id = 1; //Section id for Training Experience

		$input = $request->all();
		$session_owner_id = Session::get('owner_id');
		$session_owner_role_id = Session::get('owner_role_id');

		//CHECK IF TRAINING PROGRAM DOES NOT EXIST,CREATE A NEW ONE
		$training_program = TrainingProgram::where('training_program_name_en',$input['training_program'])->first();
		if(count($training_program) == 0)
		{
			$training_program_in = TrainingProgram::create([ 'training_program_name_en' => $input['training_program'] ]);
			$tp_id = $training_program_in->id;
		}
		else
		{
			$tp_id = $training_program->id;
		}

		//CHECK USER TRAINING PROGRAM NODE
		$insert_user_training_program = [
			'owner_id' 						=> $session_owner_id,
			'owner_role_id' 			=> $session_owner_role_id,
			'training_program_id'	=> $tp_id,
			'is_certification_included' => $input['is_certification_included'],
		];

		$userTrainingProgramNode = UserTrainingProgramNode::create($insert_user_training_program);

		//CHECK IF LEARNING OUTCOME DOES NOT EXISTS
		$lo_op = explode('|||',$input['lo_op']);
		for($i=1;$i<count($lo_op);$i++)
		{
			$this_lo_op = explode('|',$lo_op[$i]);

			$learning_outcome_str = $this_lo_op[0];

			if($learning_outcome_str != '' && $learning_outcome_str != 'undefined')
			{
				$learning_outcome = LearningOutcome::where('learning_outcome_name',$learning_outcome_str)->first();
				if(count($learning_outcome) == 0)
				{
					$learning_outcome = LearningOutcome::create([ 'learning_outcome_name' => $learning_outcome_str ]);
				}

				$utplo = [
					'learning_outcome_id' => $learning_outcome->id,
					'user_training_program_id' => $userTrainingProgramNode->id
				];

				$utploN = UserTrainingProgramLearningOutcomeNode::create($utplo);

				$outcome_preference = $this_lo_op[1];

				$utploop = [
					'user_training_program_learning_outcome_id' => $utploN->id,
					'outcome_preference_id' => $outcome_preference
				];

				UserTrainingProgramLearningOutcomeOutcomePreferenceNode::create($utploop);

			}

		}
		/*
		$learning_outcomes = explode('|||',$input['learning_outcomes']);
		for($i=0;$i<count($learning_outcomes);$i++)
		{
			$learning_outcome = $learning_outcomes[$i];
			if($learning_outcome != '')
			{
				$learning_outcome = LearningOutcome::where('learning_outcome_name',$learning_outcome)->first();
				if(count($learning_outcome) == 0)
				{
					$learning_outcome = LearningOutcome::create([ 'learning_outcome_name' => $learning_outcome ]);
				}
			}
		}*/

		return redirect('dashboard#programs');
	}

	/**
	* Display user training experience form page
	*
	* @return Response
	*/
	public function addSkill()
	{
		return view('profile.forms.add-skill');
	}

	public function createSkill(skillRequest $request)
	{

		$input = $request->all();
		$session_owner_id = Session::get('owner_id');
		$session_owner_role_id = Session::get('owner_role_id');

		$skills = explode('|||',$input['skill']);
		for($i=0;$i<count($skills);$i++)
		{
			$skill_name = $skills[$i];
			if($skill_name != '')
			{
				$skill = Skill::where('skill_name',$skill_name)->first();
				if(count($skill) == 0)
				{
					$skill = Skill::create([ 'skill_name' => $skill_name ]);
				}

				$user_skill_node = DB::table('user_skill_nodes')
													 ->where('user_skill_nodes.owner_id', '=', $session_owner_id)
													 ->where('user_skill_nodes.owner_role_id', '=', $session_owner_role_id)
													 ->where('user_skill_nodes.skill_id', '=', $skill->id)
													 ->first();

				if(count($user_skill_node) == 0):
					$insert_skill = [
						'owner_id' 						=> $session_owner_id,
						'owner_role_id' 			=> $session_owner_role_id,
						'skill_id' 						=> $skill->id,
					];
					UserSkillNode::create($insert_skill);
				endif;

			}
		}

		//echo "<script type='text/javascript'>alert('Insert Success');</script>";exit();
		return redirect('dashboard#skills');
	}

	public function deleteSkill($id)
	{
		UserSkillNode::find($id)->delete();
		UserSkillEndorseNode::where('user_skill_node_id', '=', $id)->delete();
		return redirect('dashboard#skills');
	}

	public function addEndorse($id)
	{
		$logged_user = Auth::user();
		if($logged_user):
			$logged_user_id = Auth::user()->id;
			$insert_endorse = [
				'user_skill_node_id' 	=> $id,
				'user_id' 						=> $logged_user_id,
			];
			UserSkillEndorseNode::create($insert_endorse);

			//GET ENDORSED USER TABLE
			$endorsed_role_user  = DB::table('user_skill_nodes')
														->where('user_skill_nodes.id', '=', $id)
														->first();
			if($endorsed_role_user->owner_role_id == 3){
				$table = 'providers';
				$prefix_path = 'g/';
			}else if($endorsed_role_user->owner_role_id == 4){
				$table = 'corporates';
				$prefix_path = 'c/'; // PERLU DISKUSIKAN PENAMAAN ROUTES UNTUK CORPORATE
			}else{
				$table = 'users';
				$prefix_path = 'u/';
			}

			//GET ENDORSED USER SLUG
			$endorsed_user  = DB::table('user_skill_nodes')
												->join($table,'user_skill_nodes.owner_id','=',$table.'.id')
												->where('user_skill_nodes.id', '=', $id)
												->first();

			return redirect($prefix_path.$endorsed_user->slug.'#skills');

		else:
			echo "You have to log in first";exit();
		endif;

	}

	public function deleteEndorse($id)
	{
		$logged_user = Auth::user();
		if($logged_user):
			$logged_user_id = Auth::user()->id;
			$delete_endorse = [
				'user_skill_node_id' 	=> $id,
				'user_id' 						=> $logged_user_id,
			];
			UserSkillEndorseNode::where($delete_endorse)->delete();

			//GET ENDORSED USER TABLE
			$endorsed_role_user  = DB::table('user_skill_nodes')
														->where('user_skill_nodes.id', '=', $id)
														->first();
			if($endorsed_role_user->owner_role_id == 3){
				$table = 'providers';
				$prefix_path = 'g/';
			}else if($endorsed_role_user->owner_role_id == 4){
				$table = 'corporates';
				$prefix_path = 'c/'; // PERLU DISKUSIKAN PENAMAAN ROUTES UNTUK CORPORATE
			}else{
				$table = 'users';
				$prefix_path = 'u/';
			}

			//GET ENDORSED USER SLUG
			$endorsed_user  = DB::table('user_skill_nodes')
												->join($table,'user_skill_nodes.owner_id','=',$table.'.id')
												->where('user_skill_nodes.id', '=', $id)
												->first();

			return redirect($prefix_path.$endorsed_user->slug.'#skills');

		else:
			echo "You have to log in first";exit();
		endif;
	}

	/**
	* Display user video form page
	*
	* @return Response
	*/
	public function addVideo()
	{
		return view('profile.forms.add-video');
	}

	public function createVideo(videoRequest $request)
	{
		$input = $request->all();
		$yt_id = str_replace('https://www.youtube.com/watch?v=','',$input['video_path']);
		$session_owner_id = Session::get('owner_id');
		$session_owner_role_id = Session::get('owner_role_id');


		$video = DB::table('videos')
						 ->where('videos.owner_id', '=', $session_owner_id)
						 ->where('videos.owner_role_id', '=', $session_owner_role_id)
						 ->where('videos.video_path', '=', $yt_id)
						 ->first();

		if(count($video) == 0):
			$insert_video = [
				'owner_id' 						=> $session_owner_id,
				'owner_role_id' 			=> $session_owner_role_id,
				'video_name' 					=> $input['video_name'],
				'video_path' 					=> $yt_id,
				'video_type' 					=> $input['video_type'],
				'video_description' 	=> $input['video_description']
			];

			Video::create($insert_video);
		endif;


		return redirect('dashboard#videos');
	}

	public function popupSectionVideo($video_title,$video_id)
	{
		return view('profile.yt-video-popup')
			->with('video_title',$video_title)
			->with('video_id',$video_id);
	}

	/**
	* Create Testimonial
	*
	* @return Response
	*/
	public function createTestimonial($role,$id,testimonialRequest $request)
	{
		$input 				= $request->all();
		$logged_user 	= Auth::user();
		if($logged_user):

			$logged_user_id = Auth::user()->id;

			//GET USER ROLE NODE TABLE
			$user_role_node 		= DB::table('user_role_nodes')
														->where('user_role_nodes.user_id', '=', $logged_user_id)
														->where('user_role_nodes.role_id', '!=', 3)
														->first();
			$reviewer_role_id 	= $user_role_node->role_id;

			$insert_testimonial = [
				'owner_id' 					=> $id,
				'owner_role_id' 		=> $role,
				'reviewer_id' 			=> $logged_user_id,
				'reviewer_role_id' 	=> $reviewer_role_id,
				'testimony'					=> $input['testimony'],
			];
			$testimonial = Testimonial::create($insert_testimonial);
			$new_testimonial_id = $testimonial->id;

			//GET ENDORSED USER TABLE
			if($role == 3){
				$table = 'providers';
				$prefix_path = 'g/';
			}else if($role == 4){
				$table = 'corporates';
				$prefix_path = 'c/'; // PERLU DISKUSIKAN PENAMAAN ROUTES UNTUK CORPORATE
			}else{
				$table = 'users';
				$prefix_path = 'u/';
			}

			//GET TESTIMONIAL USER SLUG
			$testimonial_user  = DB::table('testimonials')
													->join($table,'testimonials.owner_id','=',$table.'.id')
													->where('testimonials.id', '=', $new_testimonial_id)
													->first();

			return redirect($prefix_path.$testimonial_user->slug.'#testimonials');

		else:
			echo "You have to log in first";exit();
		endif;
	}

	public function popupSectionTestimonial($owner_id,$owner_role_id,$owner_name)
	{
		return view('general.send-testimonial-popup')
			->with('owner_id',$owner_id)
			->with('owner_role_id',$owner_role_id)
			->with('owner_name',$owner_name);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/**
	 * Show Ajax Listed Items
	 *
	 * @param  varchar  $table
	 * @return Response
	 */
	public function getAutoCompleteData($table,$columnName,$key)
	{

		if($columnName == '' && $key == '')
		{
			$result = DB::table($table)->get();
		}
		else
		{
			$result = DB::table($table)
				->where($columnName,'like','%'.$key.'%')
				->select($columnName)
				->get();
		}

		echo json_encode($result);
	}

	public function countFeature($feature_name)
	{
		$insert = [
			'feature_name' 	=> $feature_name,
			'ip'						=> $_SERVER['REMOTE_ADDR']
		];
		$result = DB::table('feature_tracking')->insert($insert);
	}

	public function tracking()
	{

		$arr_ftr = [
			'add_to_contact',
			'send_message',
			'training_program',
			'testimonial',
			'certification',
			'awards',
			'skills',
			'video',
			'training_experience',
			'work_experience'
		];


		echo '<h1>All Count</h1>';

		for($i=0;$i<count($arr_ftr);$i++):
			$ftr = FeatureTracking::where('feature_name',$arr_ftr[$i])->count();
			echo '<br/>';
			echo '<b>'.$arr_ftr[$i].'</b><br/> Total Count: '.$ftr;
		endfor;

		echo '<h1>Per IP</h1>';
		for($i=0;$i<count($arr_ftr);$i++):
			$ftr = FeatureTracking::where('feature_name',$arr_ftr[$i])->groupBy('ip')->count();
			echo '<br/>';
			echo '<b>'.$arr_ftr[$i].'</b><br/> Total Count: '.$ftr;
		endfor;

		$tracks = FeatureTracking::all();
		echo '<br/><br/><br/><br/><table>';
		foreach($tracks as $track):
			echo '<tr><td>'.$track->feature_name.'</td><td>IP: '.$track->ip.'</td></tr>';
		endforeach;
		echo '</table>';
	}

	public function about()
	{
		return view('landing.about');
	}

}
