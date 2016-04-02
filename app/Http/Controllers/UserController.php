<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\updateBasicProfileRequest;
use Illuminate\Http\Request;

use Auth;
use DB;

use App\Models\General;
use App\Models\User as User;
use App\Models\Corporate as Corporate;
use App\Models\JobTitle as JobTitle;
use App\Models\JobSeniorityLevel as JobSeniorityLevel;
use App\Models\JobFunction as JobFunction;
use App\Models\Video as Video;
use App\Models\JobNode as JobNode;
use App\Models\Provider as Provider;
use App\Models\Contact as Contact;

use Intervention\Image\Facades\Image;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Display current logged in user profile as the dashboard
	 *
	 * @return Response
	 */
	 public function getProfile()
	 {
		 //$users = User::all();
		 //return view('profile.profile-page')->with('gridRole',3)->withAuth(1);
	 }

	 /**
 	 * Display edit basic profile form
 	 *
 	 * @return Response
 	 */
	 public function editBasicProfile()
	 {
		 $id = Auth::user()->id;
		 $user = User::where('id',$id)->first();
		 return view('profile.forms.basic-profile')->with('user',$user);
	 }

	 /**
 	 * Update basic profile form
 	 *
 	 * @return Response
 	 */
	 public function updateBasicProfile(updateBasicProfileRequest $request)
	 {
		 $input = $request->all();
		 $id = Auth::user()->id;

		 //CHECK IF CORPORATE DOES NOT EXIST,CREATE A NEW ONE
		 if($input['corporate_name'] != NULL || $input['corporate_name'] != ""):
			 $corp_exist = Corporate::where('corporate_name',$input['corporate_name'])
	 											->count();
			 if($corp_exist == 0)
			 {
				 Corporate::create(['corporate_name' => $input['corporate_name']]);
			 }
		 endif;

		 //CHECK IF JOB TITLE DOES NOT EXIST,CREATE A NEW ONE
		 if($input['job_title'] != NULL || $input['job_title'] != ""):
			 $title_exist = JobTitle::where('job_title_name',$input['job_title'])
	 											->count();

			 if($title_exist == 0):
				 JobTitle::create(['job_title_name' => $input['job_title']]);
			 endif;

			 $job_title_id = JobTitle::where('job_title_name',$input['job_title'])
			 									->first()->id;

			 //Fetch the right JobNode or create new
			 $job_node_exist = JobNode::where('job_title_id',$job_title_id)->count();

			 $job_seniority_level = '';
			 $job_function = '';

			 if($job_node_exist == 0):
				 $job_node = JobNode::where('job_title_id',$job_title_id)->first();
				 $job_seniority_level = JobSeniorityLevel::where('id',$job_node->job_seniority_level_id)
				 														->first()->job_seniority_level_name;
				 $job_function = JobFunction::where('id',$job_node->job_function_id)
	 													->first()->job_function_name;
			 endif;
		 else:
			   $job_node = "";
				 $job_seniority_level = "";
				 $job_function = "";
		 endif;

		if ( $request->hasFile('profile_picture') )
		{
			if( $request->file('profile_picture')->isvalid() ):

				$file  						= $request->file('profile_picture');
				$file_name  			= $request->file('profile_picture')->getClientOriginalName();

				$destinationPath = public_path() . '/images/users';
	    	$request->file('profile_picture')->move($destinationPath, $file_name);
				//Resize & Crop | source image started from level public
				$img = Image::make('images/users/'.$file_name)->fit(400,400)->save('images/users/thumb/'.$file_name);


				$update = [
					'profile_picture' 			=> (isset($file_name))?$file_name:'',
				];
				$user = User::find($id)->update($update);

			else:
				$photo_error = $request->file('profile_picture')->getErrorMessage();
				echo $photo_error;
			endif;
		}

		$update = [
			'first_name' 						=> $input['first_name'],
			'last_name' 						=> $input['last_name'],

			'corporate_name' 				=> $input['corporate_name'],
			'job_title' 						=> $input['job_title'],

			'job_seniority_level' 	=> $job_seniority_level,
			'job_function' 					=> $job_function,

			'summary' 							=> $input['summary'],
			'domicle_area' 					=> $input['domicle_area'],
			'service_area' 					=> $input['service_area'],

			'address'								=> $input['address'],
			'phone_number'					=> $input['phone_number'],
			'mandays_fee'						=> $input['mandays_fee'],
			'slug'									=> $input['slug'],

			'gender' 								=> $input['gender'],
			'dob' 									=> $input['dob'],

			'training_method' 			=> $input['training_method'],
			'training_style' 				=> $input['training_style'],
		];


		$user = User::find($id)->update($update);

		$user = User::where('id',$id)->first();

		return view('profile.forms.basic-profile')->with('user',$user);


	 }

	/**
	 * Display a list of users.
	 *
	 * @return Response
	 */
	 public function getUsers()
	 {
	   $users =	DB::table('user_role_nodes')
	            ->join('roles', 'user_role_nodes.role_id', '=', 'roles.id')
	            ->join('users', 'user_role_nodes.user_id', '=', 'users.id')
	            ->where('role_id', '=', 2)
	            ->where('users.is_verified', '=', 1)
	            ->where('users.first_name', '!=', '')
	            ->where('users.slug', '!=', '')
	            ->get();

	   $users_data = array();
	   foreach($users as $user):
	       // <!-- USER EXPERTISES
	       // Get Expertises Data

	       $user_expertises =	DB::table('user_skill_nodes')
	                          ->join('skills', 'user_skill_nodes.skill_id', '=', 'skills.id')
	                          ->where('user_skill_nodes.owner_id', '=', $user->id)
	                          ->where('user_skill_nodes.owner_role_id', '=', 2)
	                          ->get();

	       $user_expertises_data  = array();
	       foreach($user_expertises as $user_expertise):
	         // Get Endorse Data
	         $user_endorses =	DB::table('user_skill_endorse_nodes')
	                          ->where('user_skill_endorse_nodes.user_skill_node_id', '=', $user_expertise->id)
	                          ->get();

	         $user_expertise_data  = array(
	           "expertise_name"			=> $user_expertise->skill_name,
	           "total_endorse"			=> count($user_endorses),
	         );
	         array_push($user_expertises_data,$user_expertise_data);
	       endforeach;
	       // USER EXPERTISES -->



	       //<!-- SPEAKING EXPERIENCE
	       $user_speaking_experience =	DB::table('training_experiences')
	                                    ->where('training_experiences.owner_id', '=', $user->id)
	                                    ->where('training_experiences.owner_role_id', '=', 2)
	                                    ->get();

	       $total_user_speaking_experience_data = count($user_speaking_experience);
	       // SPEAKING EXPERIENCE -->

	       //<!-- LANGUAGE PROFIECIENCY
	       $user_languages =	DB::table('user_language_nodes')
	                          ->join('languages', 'user_language_nodes.language_id' ,'=', 'languages.id')
	                          ->where('user_language_nodes.owner_id', '=', $user->id)
	                          ->where('user_language_nodes.owner_role_id', '=', 2)
	                          ->get();

	       $user_languages_data = array();
	       foreach($user_languages as $user_language):
	         $user_language_data = array(
	           "language_name"		=> $user_language->language,
	         );
	         array_push($user_languages_data,$user_language_data);
	       endforeach;
	       // LANGUAGE PROFIECIENCY -->


	       //<!-- REVIEW
	       /*
	       $user_reviews_query =
	       [
	         "table"		 => "tr_review",
	         "join"			 =>
	                     [
	                       "user"	=>
	                               [
	                                 "statement"	=> "tr_review.reviewer_id = user.user_id",
	                                 "type"				=> "join",
	                               ],
	                      ],
	         "condition"	=>
	                      [
	                       "0"		=>
	                             [
	                               "column"				=> "tr_review.user_id",
	                               "comparison"		=> "=",
	                               "value"				=> $user->id,
	                             ],
	                      ],
	       ];
	       $user_reviews = General::Selects($user_reviews_query)->get();

	       $score 	= 0;
	       $flag 	= 0;
	       foreach($user_reviews as $user_review):
	          if($user_review->delivery_score > 0):
	            $score = $score + $user_review->delivery_score;
	            $flag++;
	          endif;
	       endforeach;
	       if($flag > 0):
	         $score = round((float)$score / $flag,1);
	       endif;

	       $total_user_review_data = count($user_reviews);
	       if($score == 0):
	         $average_user_review_score_data 			= "-"; //N/A
	       else:
	         $average_user_review_score_data 			= $score;
	       endif;
	       */
	       $total_user_review_data = 0;
	       $average_user_review_score_data = "-";
	       // REVIEW -->

	       //CONTACT
	       $user_contact =	DB::table('contacts')
                          ->where('contacts.contact_owner_id', '=', $user->id)
                          ->where('contacts.contact_owner_role_id', '=', 2)
                          ->get();

	       $total_user_connection_data = count($user_contact);
				 // CONTACT -->

	       //ALL TRAINER DATA
	       $user_data = array(
	         "user_id"													=> $user->id,
	         "name"															=> $user->first_name . ' ' . $user->last_name,
	         "email"														=> $user->email,
	         "profile_picture"									=> $user->profile_picture,
	         "summary"													=> $user->summary,
	         "area"															=> $user->service_area,
	         "slug"												  		=> $user->slug,
	         "language"													=> $user_languages_data,
	         "score"														=> $average_user_review_score_data,
	         "expertises"												=> $user_expertises_data,
	         "connection"												=> $total_user_connection_data,
	         "training"													=> $total_user_speaking_experience_data,
	         "review"														=> $total_user_review_data,
	         "view"															=> $user->is_view,
	       );
	       array_push($users_data,$user_data);
	   endforeach;

	   $users_data_object = json_decode(json_encode($users_data), FALSE);

	   return view('search.grid-list')
	     ->withGrids($users_data_object)
	     ->with('gridType',1);
	 }

	 /**
 	 * Display user profile page
 	 *
 	 * @return Response
 	 */
	 public function getUser($user_slug = '')
	 {
		 if($user_slug == '')
		 {
			 $user_slug = Auth::user()->slug;
		 }

		 $user =	DB::table('user_role_nodes')
							->join('roles', 'user_role_nodes.role_id', '=', 'roles.id')
							->join('users', 'user_role_nodes.user_id', '=', 'users.id')
							->where('users.is_verified', '=', 1)
							->where('users.slug', '=', $user_slug)
							->first();

		 if(count($user) == 0 ):
			  echo "<b>User Is Not Found</b>";
				exit();
		 else:
				// <!-- USER EXPERTISES
				// Get Expertises Data
				$user_expertises =	DB::table('user_skill_nodes')
													 ->join('skills', 'user_skill_nodes.skill_id', '=', 'skills.id')
													 ->where('user_skill_nodes.owner_id', '=', $user->id)
													 ->where('user_skill_nodes.owner_role_id', '=', 2)
													 ->get();

				$user_expertises_data  = array();
				foreach($user_expertises as $user_expertise):
					// Get Endorse Data

					$user_endorses =	DB::table('user_skill_endorse_nodes')
													 ->join('users','user_skill_endorse_nodes.user_id','=','users.id')
													 ->where('user_skill_endorse_nodes.user_skill_node_id', '=', $user_expertise->id)
													 ->get();

					$user_endorses_data = array();
					foreach($user_endorses as $user_endorse):

						$user_endorse_data  = array(
								"profile_picture"		=>	$user_endorse->profile_picture,
								"first_name"				=>	$user_endorse->first_name,
								"last_name"					=>	$user_endorse->last_name,
						);
						array_push($user_endorses_data,$user_endorse_data);
					endforeach;

					$user_expertise_data  = array(
						"expertise_name"		=> $user_expertise->skill_name,
						"total_endorse"			=> count($user_endorses),
						"endorse_users"			=> $user_endorses_data,
					);
					array_push($user_expertises_data,$user_expertise_data);
				endforeach;
				// USER EXPERTISES -->

			//<!-- LANGUAGE PROFIECIENCY
			$user_languages =	DB::table('user_language_nodes')
												 ->join('languages', 'user_language_nodes.language_id' ,'=', 'languages.id')
												 ->where('user_language_nodes.owner_id', '=', $user->id)
												 ->where('user_language_nodes.owner_role_id', '=', 2)
												 ->get();

			$user_languages_data = array();
			foreach($user_languages as $user_language):
				$user_language_data = array(
					"language_name"		=> $user_language->language,
				);
				array_push($user_languages_data,$user_language_data);
			endforeach;
			// LANGUAGE PROFIECIENCY -->

			//<!-- REVIEW
			/*
			$user_reviews_query =
			[
				"table"			=> "tr_review",
				"join"			=>
										[
											"user"	=>
															[
																"statement"	=> "user.user_id = tr_review.reviewer_id",
																"type"			=> "join",
															],
										],
				"condition"	=>
										[
											"0"		=>
														[
															"column"			=>  "tr_review.user_id",
															"comparison"	=>	"=",
															"value"				=>	$user->user_id,
														],
										],
			];
			$user_reviews = General::Selects($user_reviews_query)->get();

			$score 	= 0;
			$flag 	= 0;
			foreach($user_reviews as $user_review):
		     if($user_review->delivery_score > 0):
		       $score = $score + $user_review->delivery_score;
		       $flag++;
		     endif;
			endforeach;
			if($flag > 0):
				$score = round((float)$score / $flag,1);
			endif;

			$total_user_review_data = count($user_reviews);
			if($score == 0):
				$total_user_review_score_data 			= "-"; //N/A
			else:
				$total_user_review_score_data 			= $score;
			endif;
			*/
			// REVIEW -->
			$total_user_review_score_data = "-";
			$user_reviews = array();
			///////////////////
			//// TABS DATA ////
			///////////////////
			//<!--TRAINING EXPERIENCES
			$user_speaking_experiences =	DB::table('training_experience_program_nodes')
												  				 ->select('*','training_experiences.id AS training_experience_id')
																	 ->join('training_experiences','training_experience_program_nodes.training_experience_id','=','training_experiences.id')
																	 ->join('training_program','training_experience_program_nodes.training_program_id','=','training_program.id')
																	 ->join('providers','training_experiences.provider_id','=','providers.id')
																	 ->join('corporates','training_experiences.corporate_id','=','corporates.id')
																	 ->where('training_experiences.owner_id', '=', $user->id)
																	 ->where('training_experiences.owner_role_id', '=', 2)
																	 ->get();

			$user_speaking_experiences_data  = array();
			foreach($user_speaking_experiences as $user_speaking_experience):


				//SKILL TRAINING EXPERIENCE
				$user_speaking_experience_expertises =	DB::table('section_skills')
																								 ->join('skills','section_skills.skill_id','=','skills.id')
																								 ->where('section_skills.section_id', '=', 1)
																								 ->where('section_skills.section_item_id', '=', $user_speaking_experience->training_experience_id)
																								 ->get();

				$user_speaking_experience_expertises_data = array();
				foreach($user_speaking_experience_expertises as $user_speaking_experience_expertise):
					$user_speaking_experience_expertise_data = array(
						"expertise_name"		=>	$user_speaking_experience_expertise->skill_name,
					);
					array_push($user_speaking_experience_expertises_data,$user_speaking_experience_expertise_data);
				endforeach;



				//PHOTO TRAINING EXPERIENCE
				$user_speaking_experience_photos = DB::table('section_photos')
																					 ->where('section_photos.section_id', '=', 1)
																					 ->where('section_photos.section_item_id', '=', $user_speaking_experience->training_experience_id)
																					 ->get();

				$user_speaking_experience_photos_data = array();
				foreach($user_speaking_experience_photos as $user_speaking_experience_photo):
					$user_speaking_experience_photo_data = array(
						"photo_name"					=>	$user_speaking_experience_photo->photo_name,
						"photo_path"					=>	$user_speaking_experience_photo->photo_path,
						"photo_description"		=>	$user_speaking_experience_photo->photo_description,
					);
					array_push($user_speaking_experience_photos_data,$user_speaking_experience_photo_data);
				endforeach;

				//VIDEO TRAINING EXPERIENCE
				$user_speaking_experience_videos = DB::table('section_videos')
																					 ->where('section_videos.section_id', '=', 1)
																					 ->where('section_videos.section_item_id', '=', $user_speaking_experience->training_experience_id)
																					 ->where('section_videos.video_type', '=', "youtube")
																					 ->get();

				$user_speaking_experience_videos_data = array();
				foreach($user_speaking_experience_videos as $user_speaking_experience_video):
					$user_speaking_experience_video_data = array(
						"video_name"					=>	$user_speaking_experience_video->video_name,
						"video_path"					=>	$user_speaking_experience_video->video_path,
						"video_description"		=>	$user_speaking_experience_video->video_description,
					);
					array_push($user_speaking_experience_videos_data,$user_speaking_experience_video_data);
				endforeach;

				//SUMMARY TRAINING EXPERIENCES VARIABLE
				$user_speaking_experience_data  = array(
					"speaking_experience_id"					  	=>		$user_speaking_experience->training_experience_id,
					"speaking_experience_title"					  =>		$user_speaking_experience->training_experience,
					"speaking_experience_description"			=>		$user_speaking_experience->description,
					"speaking_experience_start_date"		  =>		$user_speaking_experience->start_date,
					"speaking_experience_end_date"				=>		$user_speaking_experience->end_date,
					"company_profile_picture"					  	=>		$user_speaking_experience->corporate_profile_picture,
					"company_name"											  =>		$user_speaking_experience->corporate_name,
					"provider_profile_picture"					  =>		$user_speaking_experience->profile_picture,
					"provider_name"											  =>		$user_speaking_experience->provider_name,
					"speaking_experience_expertises"			=>		$user_speaking_experience_expertises_data,
					"speaking_experience_photos"					=>		$user_speaking_experience_photos_data,
					"speaking_experience_videos"					=>		$user_speaking_experience_videos_data,
					"training_programme_title"						=>		$user_speaking_experience->training_program_name_id,
				);
				array_push($user_speaking_experiences_data,$user_speaking_experience_data);

			endforeach;

			// TRAINING EXPERIENCES -->

			//<!--WORK EXPERIENCES
			$user_work_experiences =	DB::table('work_experiences')
																 ->select('*','work_experiences.id AS work_experience_id')
																 ->join('corporates','work_experiences.corporate_id','=','corporates.id')
																 ->where('work_experiences.owner_id', '=', $user->id)
																 ->where('work_experiences.owner_role_id', '=', 2)
																 ->get();

			// WORK EXPERIENCES -->

			//<!--TRAINING PROGRAMME
			$user_training_programs =	DB::table('user_training_program_nodes')
																 	 ->select('*','training_program.id AS training_program_id'
																	 						 ,'user_training_program_nodes.id AS user_training_program_nodes_id' )
																	 ->join('training_program','user_training_program_nodes.training_program_id','=','training_program.id')
																	 ->where('user_training_program_nodes.owner_id', '=', $user->id)
																	 ->where('user_training_program_nodes.owner_role_id', '=', 2)
																	 ->get();

			$user_training_programs_data = array();
			foreach($user_training_programs as $user_training_program):

				//Learning Outcome
				$user_training_program_learning_outcomes =
				DB::table('user_training_program_learning_outcome_nodes')
				->select('*','user_training_program_learning_outcome_nodes.id AS user_training_program_learning_outcome_nodes_id')
				->join('learning_outcomes','user_training_program_learning_outcome_nodes.learning_outcome_id','=','learning_outcomes.id')
				->where('user_training_program_learning_outcome_nodes.user_training_program_id', '=', $user_training_program->user_training_program_nodes_id)
				->get();

				$user_training_programs_learning_outcomes_data = array();
				foreach($user_training_program_learning_outcomes as $user_training_program_learning_outcome):

					//outcome preferences
					$user_training_program_learning_outcome_outcome_preferences =
					DB::table('user_training_program_learning_outcome_outcome_preference_nodes')
					->join('outcome_preferences','user_training_program_learning_outcome_outcome_preference_nodes.outcome_preference_id','=','outcome_preferences.id')
					->where('user_training_program_learning_outcome_outcome_preference_nodes.user_training_program_learning_outcome_id', '=', $user_training_program_learning_outcome->user_training_program_learning_outcome_nodes_id)
					->get();

					$user_training_program_learning_outcome_outcome_preferences_data = array();
					foreach($user_training_program_learning_outcome_outcome_preferences as $user_training_program_learning_outcome_outcome_preference):

						$user_training_program_learning_outcome_outcome_preference_data = array(
									"outcome_preference_name" => $user_training_program_learning_outcome_outcome_preference->outcome_preference_name,
						);
						array_push($user_training_program_learning_outcome_outcome_preferences_data,$user_training_program_learning_outcome_outcome_preference_data);
					endforeach;


					$user_training_programs_learning_outcome_data = array(
							"learning_outcome_name"				=> $user_training_program_learning_outcome->learning_outcome_name,
							"outcome_preference_names"		=> $user_training_program_learning_outcome_outcome_preferences_data,
					);
					array_push($user_training_programs_learning_outcomes_data,$user_training_programs_learning_outcome_data);
				endforeach;


				$user_training_program_data = array(
						"training_program_id"					=> $user_training_program->training_program_id,
						"training_program_name_id"		=> $user_training_program->training_program_name_id,
						"learning_outcome_names"			=> $user_training_programs_learning_outcomes_data,
				);


				array_push($user_training_programs_data,$user_training_program_data);
			endforeach;
			// TRAINING PROGRAMME-->

			//<!--CERTIFICATION

			$user_certifications =	DB::table('certifications')
															->where('certifications.owner_id', '=', $user->id)
															->where('certifications.owner_role_id', '=', 2)
															->get();

			$user_certifications_data  = array();
			foreach($user_certifications as $user_certification):

				//SKILL CERTIFICATION
				$user_certification_expertises =	DB::table('section_skills')
																				 ->join('skills','section_skills.skill_id','=','skills.id')
																				 ->where('section_skills.section_id', '=', 7)
																				 ->where('section_skills.section_item_id', '=', $user_certification->id)
																				 ->get();

				$user_certification_expertises_data = array();
				foreach($user_certification_expertises as $user_certification_expertise):
					$user_certification_expertise_data = array(
						"expertise_name"		=>	$user_certification_expertise->skill_name,
					);
					array_push($user_certification_expertises_data,$user_certification_expertise_data);
				endforeach;

				//PHOTO CERTIFICATION
				$user_certification_photos = DB::table('section_photos')
																					 ->where('section_photos.section_id', '=', 7)
																					 ->where('section_photos.section_item_id', '=', $user_certification->id)
																					 ->get();

				$user_certification_photos_data = array();
				foreach($user_certification_photos as $user_certification_photo):
					$user_certification_photo_data = array(
						"photo_name"					=>	$user_certification_photo->photo_name,
						"photo_path"					=>	$user_certification_photo->photo_path,
						"photo_description"		=>	$user_certification_photo->photo_description,
					);
					array_push($user_certification_photos_data,$user_certification_photo_data);
				endforeach;

				//VIDEO CERTIFICATION
				$user_certification_videos = DB::table('section_videos')
																		 ->where('section_videos.section_id', '=', 7)
																		 ->where('section_videos.section_item_id', '=', $user_certification->id)
																		 ->get();

				$user_certification_videos_data = array();
				foreach($user_certification_videos as $user_certification_video):
					$user_certification_video_data = array(
						"video_name"					=>	$user_certification_video->video_name,
						"video_path"					=>	$user_certification_video->video_path,
						"video_description"		=>	$user_certification_video->video_description,
					);
					array_push($user_certification_videos_data,$user_certification_video_data);
				endforeach;

				//SUMMARY CERTIFICATION VARIABLE
				$user_certification_data  = array(
					"certification_id"					  	=>		$user_certification->id,
					"certification_title"					  =>		$user_certification->title,
					"certification_description"			=>		$user_certification->description,
					"certification_publisher_name"	=>		$user_certification->publisher,
					"certification_date"					  =>		$user_certification->published_date,
					"certification_expertises"			=>		$user_certification_expertises_data,
					"certification_photos"					=>		$user_certification_photos_data,
					"certification_videos"					=>		$user_certification_videos_data
				);
				array_push($user_certifications_data,$user_certification_data);

			endforeach;
			// CERTIFICATION -->

			//<!--AWARD
			$user_awards =	DB::table('awards')
                      ->where('awards.owner_id', '=', $user->id)
                      ->where('awards.owner_role_id', '=', 2)
                      ->get();

			$user_awards_data  = array();
			foreach($user_awards as $user_award):

			  //SKILL award
			  $user_award_expertises =	DB::table('section_skills')
                                   ->join('skills','section_skills.skill_id','=','skills.id')
                                   ->where('section_skills.section_id', '=', 8)
                                   ->where('section_skills.section_item_id', '=', $user_award->id)
                                   ->get();

			  $user_award_expertises_data = array();
			  foreach($user_award_expertises as $user_award_expertise):
			    $user_award_expertise_data = array(
			      "expertise_name"		=>	$user_award_expertise->skill_name,
			    );
			    array_push($user_award_expertises_data,$user_award_expertise_data);
			  endforeach;

			  //PHOTO award
			  $user_award_photos = DB::table('section_photos')
                             ->where('section_photos.section_id', '=', 8)
                             ->where('section_photos.section_item_id', '=', $user_award->id)
                             ->get();

			  $user_award_photos_data = array();
			  foreach($user_award_photos as $user_award_photo):
			    $user_award_photo_data = array(
			      "photo_name"					=>	$user_award_photo->photo_name,
			      "photo_path"					=>	$user_award_photo->photo_path,
			      "photo_description"		=>	$user_award_photo->photo_description,
			    );
			    array_push($user_award_photos_data,$user_award_photo_data);
			  endforeach;

			  //VIDEO award
			  $user_award_videos = DB::table('section_videos')
                             ->where('section_videos.section_id', '=', 8)
                             ->where('section_videos.section_item_id', '=', $user_award->id)
                             ->get();

			  $user_award_videos_data = array();
			  foreach($user_award_videos as $user_award_video):
			    $user_award_video_data = array(
			      "video_name"					=>	$user_award_video->video_name,
			      "video_path"					=>	$user_award_video->video_path,
			      "video_description"		=>	$user_award_video->video_description,
			    );
			    array_push($user_award_videos_data,$user_award_video_data);
			  endforeach;

			  //SUMMARY award VARIABLE
			  $user_award_data  = array(
			    "award_id"					  	=>		$user_award->id,
			    "award_title"					  =>		$user_award->title,
			    "award_description"			=>		$user_award->description,
			    "award_publisher_name"	=>		$user_award->publisher,
			    "award_date"					  =>		$user_award->published_date,
			    "award_expertises"			=>		$user_award_expertises_data,
			    "award_photos"					=>		$user_award_photos_data,
			    "award_videos"					=>		$user_award_videos_data
			  );
			  array_push($user_awards_data,$user_award_data);

			endforeach;
			// AWARD -->

			//SUMMARY TRAINER PROFILING VARIABLE

			$user_data = array(
				"user_id"														=> $user->id,
				"name"															=> $user->first_name .' '. $user->last_name,
				"phone_number"											=> $user->phone_number,
				"email"															=> $user->email,
				"service_area"											=> $user->service_area,
				"profile_picture"										=> $user->profile_picture,
				"summary"														=> $user->summary,
				"area"															=> $user->service_area,
				"slug"												  		=> $user->slug,
				"languages"													=> $user_languages_data,
				"score"															=> $total_user_review_score_data,
				"expertises"												=> $user_expertises_data,
			);

			//PASSING VARIABLES TO VIEW
			$user_data 														= json_decode(json_encode($user_data), FALSE);
			$user_training_experiences 						= json_decode(json_encode($user_speaking_experiences_data), FALSE); // ARRAY DATA
			$user_work_experiences 								= json_decode(json_encode($user_work_experiences), FALSE); // OBJECT DATA
			$user_training_programmes							= json_decode(json_encode($user_training_programs_data), FALSE); // OBJECT DATA
			$user_testimonials										= json_decode(json_encode($user_reviews), FALSE); // OBJECT DATA
			$user_certifications									= json_decode(json_encode($user_certifications_data), FALSE); // ARRAY DATA
			$user_awards													= json_decode(json_encode($user_awards_data), FALSE); // ARRAY DATA
			$user_expertises											= json_decode(json_encode($user_expertises_data),FALSE);

			// <!--VIDEOS
			$user_videos =	Video::where('owner_id',$user->id)->where('owner_role_id',2)->get();
			// VIDEOS -->

			// IS A CONTACT
				$is_contact = '';
			if(Auth::check()):
				$is_contact =	Contact::where('owner_id',Auth::user()->id)
											->where('contact_owner_id',$user->id)
											->where('contact_owner_role_id',2)
											->count();
			endif;
			// IS A CONTACT -->

			// <!--CHECK USER HAVE PROVIDER
			$check_provider =	DB::table('user_provider_corporate_nodes')
											 ->where('user_provider_corporate_nodes.user_id', '=', $user->id)
											 ->where('user_provider_corporate_nodes.group_role_id', '=', 1) // Table Providers
											 ->first();
			// CHECK USER HAVE PROVIDER-->

			// <!-- IS ADMIN
			$admin = Auth::user();
 		 	$check_admin = 0;


			if(isset($user)):
				$admin_id = Auth::user()->id;
				if($admin_id == $user->id):
					$check_admin = 1;
				endif;
			endif;
			// IS ADMIN-->

			return view('profile/profile-page')
								->with('grids',$user_data)
								->with('trainingExperiences',$user_training_experiences)
								->with('workExperiences',$user_work_experiences)
								->with('trainingProgrammes',$user_training_programmes)
								->with('testimonials',$user_testimonials)
								->with('certifications',$user_certifications)
								->with('awards',$user_awards)
								->with('expertises',$user_expertises)
								->with('videos',$user_videos)
								->with('is_contact',$is_contact)
								->with('is_admin',$check_admin)
								->with('provider',count($check_provider))
								->with('gridType',"Freelance Trainer") // Freelance Trainer
								->with('role',1);
		endif;
	 }

	 public function getContacts()
	 {
		 $users_query =
		 [
			 "table"			=> "user",
			 "condition"	=>
									 [
										 "0"		=>
													 [
														 "column"				=>  "user.role_id",
														 "comparison"		=>	"=",
														 "value"				=>	3,
													 ],
										 /*"1"		=>
													 [
														 "column"			=>  "user.is_active",
														 "comparison"	=>	"=",
														 "value"				=>	"1",
													 ],*/
										 "2"		=>
													 [
														 "column"				=>  "user.first_name",
														 "comparison"		=>	"!=",
														 "value"				=>	"",
													 ],
										 /*"3"		=>
														[
															"column"			=>  "user.profile_image",
															"comparison"	=>	"!=",
															"value"				=>	"default.png",
														],*/
											"4"	 =>
														 [
															 "column"				=>  "user.user_slug",
															 "comparison"		=>	"!=",
															 "value"				=>	"",
														 ],
									 ],
		 ];
		 $users = General::Selects($users_query)->get();

		 $users_data = array();
		 foreach($users as $user):
				 // <!-- USER EXPERTISES
				 // Get Expertises Data
				 $user_expertises_query =
				 [
					 "table"			=> "tr_user_expertise",
					 "join"				=>
												 [
													 "expertise"	=>
																	 [
																		 "statement"	=> "expertise.expertise_id = tr_user_expertise.expertise_id",
																		 "type"				=> "join",
																	 ],
												 ],
					 "condition"	=>
												 [
													 "0"		=>
																 [
																	 "column"				=>  "tr_user_expertise.user_id",
																	 "comparison"		=>	"=",
																	 "value"				=>	$user->user_id,
																 ],

												 ],
				 ];
				 $user_expertises = General::Selects($user_expertises_query)->get();

				 $user_expertises_data  = array();
				 foreach($user_expertises as $user_expertise):
					 // Get Endorse Data
					 $user_endorses_query =
					 [
						 "table"			=> "tr_endorse",
						 "condition"	=>
													 [
														 "0"		=>
																	 [
																		 "column"			=>  "tr_endorse.tr_user_expertise_id",
																		 "comparison"	=>	"=",
																		 "value"				=>	$user_expertise->tr_user_expertise_id,
																	 ],
													 ],
					 ];
					 $user_endorses = General::Selects($user_endorses_query)->get();

					 $user_expertise_data  = array(
						 "expertise_name"			=> $user_expertise->expertise_name,
						 "total_endorse"			=> count($user_endorses),
					 );
					 array_push($user_expertises_data,$user_expertise_data);
				 endforeach;
				 // USER EXPERTISES -->

				 //<!-- SPEAKING EXPERIENCE
				 $user_speaking_experience_query =
				 [
					 "table"		 	=> "tr_speaking_experience",
					 "condition"	=>
												[
												 "0"		=>
															 [
																 "column"			  =>  "tr_speaking_experience.user_id",
																 "comparison"	  =>	"=",
																 "value"				=>	$user->user_id,
															 ],
												],
				 ];
				 $user_speaking_experience = General::Selects($user_speaking_experience_query)->get();
				 $total_user_speaking_experience_data = count($user_speaking_experience);
				 // SPEAKING EXPERIENCE -->

				 //<!-- LANGUAGE PROFIECIENCY
				 $user_languages_query =
				 [
					 "table"			=> "tr_language",
					 "condition"	=>
											 [
												 "0"		=>
															 [
																 "column"			=>  "tr_language.user_id",
																 "comparison"	=>	"=",
																 "value"				=>	$user->user_id,
															 ],
											 ],
				 ];
				 $user_languages = General::Selects($user_languages_query)->get();

				 $user_languages_data = array();
				 foreach($user_languages as $user_language):
					 $user_language_data = array(
						 "language_name"		=> $user_language->language_code,
					 );
					 array_push($user_languages_data,$user_language_data);
				 endforeach;
				 // LANGUAGE PROFIECIENCY -->

				 //<!-- REVIEW
				 $user_reviews_query =
				 [
					 "table"		 => "tr_review",
					 "join"			 =>
											 [
												 "user"	=>
																 [
																	 "statement"	=> "tr_review.reviewer_id = user.user_id",
																	 "type"				=> "join",
																 ],
												],
					 "condition"	=>
												[
												 "0"		=>
															 [
																 "column"				=> "tr_review.user_id",
																 "comparison"		=> "=",
																 "value"				=> $user->user_id,
															 ],
												],
				 ];
				 $user_reviews = General::Selects($user_reviews_query)->get();

				 $score 	= 0;
				 $flag 	= 0;
				 foreach($user_reviews as $user_review):
						if($user_review->delivery_score > 0):
							$score = $score + $user_review->delivery_score;
							$flag++;
						endif;
				 endforeach;
				 if($flag > 0):
					 $score = round((float)$score / $flag,1);
				 endif;

				 $total_user_review_data = count($user_reviews);
				 if($score == 0):
					 $average_user_review_score_data 			= "-"; //N/A
				 else:
					 $average_user_review_score_data 			= $score;
				 endif;
				 // REVIEW -->

				 //CONNECTION
				 $user_connections_query =
				 [
					 "table"			=> "tr_connect",
					 "condition"	=>
											 [
												 "0"		=>
															 [
																 "column"			=>  "tr_connect.user_id",
																 "comparison"	=>	"=",
																 "value"				=>	$user->user_id,
															 ],
											 ],
				 ];
				 $user_connections 					= General::Selects($user_reviews_query)->get();
				 $total_user_connection_data = count($user_connections);

				 //ALL TRAINER DATA
				 $user_data = array(
					 "user_id"													=> $user->user_id,
					 "name"															=> $user->first_name . ' ' . $user->last_name,
					 "email"														=> $user->email,
					 "profile_picture"									=> $user->profile_image,
					 "summary"													=> $user->summary,
					 "area"															=> $user->area,
					 "slug"												  		=> $user->user_slug,
					 "language"													=> $user_languages_data,
					 "score"														=> $average_user_review_score_data,
					 "expertises"												=> $user_expertises_data,
					 "connection"												=> $total_user_connection_data,
					 "training"													=> $total_user_speaking_experience_data,
					 "review"														=> $total_user_review_data,
					 "view"															=> $user->is_view,
				 );
				 array_push($users_data,$user_data);
		 endforeach;

		 $users_data_object = json_decode(json_encode($users_data), FALSE);

		 return view('profile.contacts')
			 ->withGrids($users_data_object)
			 ->with('gridType',1);
		 //return view('profile/contacts');
	 }

	 /**
 	 * Show the form for creating a new resource.
 	 *
 	 * @return Response
 	 */
 	public function getPlans()
 	{
 		return view('settings/pricing-plans');
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

}
