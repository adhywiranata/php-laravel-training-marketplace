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

//Photo
use App\Models\SectionPhoto as SectionPhoto;

//Training Program
use App\Models\TrainingProgram as TrainingProgram;
use App\Models\UserTrainingProgramNode as UserTrainingProgramNode;

//Certification
use App\Models\Certification as Certification;

//Award
use App\Models\Award as Award;

//Video
use App\Models\Video as Video;

//Learning Outcome
use App\Models\LearningOutcome as LearningOutcome;

use App\Http\Requests\trainingExperienceRequest;
use App\Http\Requests\workExperienceRequest;
use App\Http\Requests\trainingProgramRequest;
use App\Http\Requests\certificationRequest;
use App\Http\Requests\awardRequest;
use App\Http\Requests\skillRequest;
use App\Http\Requests\videoRequest;
use App\Http\Requests\SignUpLandingRequest;


use App\Models\UserRoleNode as UserRoleNode;


use App\Models\JobTitle as JobTitle;
use App\Models\JobSeniorityLevel as JobSeniorityLevel;
use App\Models\JobFunction as JobFunction;
use App\Models\JobNode as JobNode;
use App\Models\Provider as Provider;

use Intervention\Image\Facades\Image;

class GeneralController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
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

	public function signup_basic($role)
	{
		return view('landing.signup')->with('role',$role);
	}

	public function createUserFromLanding(SignUpLandingRequest $request,$role)
	{

		// role 1 for basic, 2 for freelance, 3 for provider
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

			 $file  						= $request->file('profile_picture');
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
		 'domicle_area' 				=> $input['domicle_area'],
		 'service_area' 				=> $input['service_area'],

		 'gender' 							=> $input['gender'],
		 'dob' 									=> $input['dob'],

		 'training_method' 			=> $input['training_method'],
		 'training_style' 			=> $input['training_style'],
		 'profile_picture' 			=> (isset($file_name))?$file_name:'',
	 ];

	 $user = User::create($create);

	 $create_node = [
		 'user_id' => $user->id,
		 'role_id' => $role
	 ];
	 $userRoleNode = UserRoleNode::create($create_node);

	 redirect('');

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

		return redirect('dashboard');
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

		return redirect('dashboard');
	}

	public function deleteTrainingExperience($id)
	{
		TrainingExperience::find($id)->delete();
		TrainingExperienceProgramNode::where('training_experience_id','=',$id)->delete();
		SectionSkill::where('section_item_id','=',$id)->delete();
		SectionPhoto::where('section_item_id','=',$id)->delete();

		return redirect('dashboard');
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
			'position' 						=> $input['position'],
			'description' 				=> $input['description'],
			'start_date' 					=> $input['start_date_year']."-".$input['start_date_month']."-".$input['start_date_day'],
			'end_date' 						=> $input['end_date_year']."-".$input['end_date_month']."-".$input['end_date_day'],
		];
		WorkExperience::create($insert_work_experience);

		return redirect('dashboard');
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
			'position' 						=> $input['position'],
			'description' 				=> $input['description'],
			'start_date' 					=> $input['start_date_year']."-".$input['start_date_month']."-".$input['start_date_day'],
			'end_date' 						=> $input['end_date_year']."-".$input['end_date_month']."-".$input['end_date_day'],
		];
		WorkExperience::find($id)->update($update_work_experience);


		return redirect('dashboard');
	}

	public function deleteWorkExperience($id)
	{
		WorkExperience::find($id)->delete();

		return redirect('dashboard');
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
					'section_id' => $section_id,
					'section_item_id' => $new_certification_id,
					'skill_id' => $skill->id
				];

				SectionSkill::create($node_insert);
			}
		}

		return redirect('dashboard');
	}

	public function editCertification($id)
	{
		$certification	=		DB::table('certifications')
												  ->where('certifications.id', '=', $id)
												  ->first();

		return view('profile.forms.add-certification')
								->with('certification',$certification);
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

				$node_insert = [
					'section_id' => $section_id,
					'section_item_id' => $new_certification_id,
					'skill_id' => $skill->id
				];

				SectionSkill::create($node_insert);
			}
		}

		return redirect('dashboard');
	}

	public function deleteCertification($id)
	{
		Certification::find($id)->delete();

		return redirect('dashboard');
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

		return redirect('dashboard');
	}

	public function editAward($id)
	{
		$award	=	DB::table('awards')
												  ->where('awards.id', '=', $id)
												  ->first();

		return view('profile.forms.add-award')
								->with('award',$award);
	}

	public function updateAward(certificationRequest $request, $id)
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

		return redirect('dashboard');
	}

	public function deleteAward($id)
	{
		Award::find($id)->delete();

		return redirect('dashboard');
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

		UserTrainingProgramNode::create($insert_user_training_program);

		//CHECK IF LEARNING OUTCOME DOES NOT EXISTS
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
		}

		return redirect('dashboard');
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

		//CHECK IF SKILL DOES NOT EXIST,CREATE A NEW ONE
		$skill = Skill::where('skill_name',$input['skill'])->first();
		if(count($skill) == 0)
		{
			$skill = Skill::create([ 'skill_name' => $input['skill'] ]);
		}


		$insert_skill = [
			'owner_id' 						=> $session_owner_id,
			'owner_role_id' 			=> $session_owner_role_id,
			'skill_id' 						=> $skill->id,
		];
		UserSkillNode::create($insert_skill);

		echo "<script type='text/javascript'>alert('Insert Success');</script>";exit();

	}

	/**
	* Display user award form page
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

		$insert_video = [
			'owner_id' 						=> $session_owner_id,
			'owner_role_id' 			=> $session_owner_role_id,
			'video_name' 					=> $input['video_name'],
			'video_path' 					=> $yt_id,
			'video_type' 					=> $input['video_type'],
			'video_description' 	=> $input['video_description']
		];

		Video::create($insert_video);

		return redirect('dashboard');
	}

	public function popupSectionVideo($video_title,$video_id)
	{
		return view('profile.yt-video-popup')
			->with('video_title',$video_title)
			->with('video_id',$video_id);
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

}
