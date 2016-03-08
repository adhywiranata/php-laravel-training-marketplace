<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\updateBasicProfileRequest;
use Illuminate\Http\Request;
use Auth;
use DB;

use App\Models\General;
use App\Models\User as User;
use App\Models\Provider as Provider;

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

	public function hack1()
	{
		echo 'hey fuck';
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
		 $id = Auth::user()->user_id;
		 $user = User::where('user_id',$id)->first();
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
		 $user_id = Auth::user()->user_id;

		 $update = [
			 'first_name' 		=> $input['first_name'],
			 'last_name' 			=> $input['last_name'],
			 'email' 					=> $input['email'],
			 'summary' 				=> $input['summary'],
			 'area' 					=> $input['address'],
			 'gender' 				=> $input['gender'],
			 'dob' 						=> $input['dob'],
		 ];

		 $user = User::find($user_id)->update();

		 $group_found = Group::where('group_name',$input['group_name'])->count();

		 if($group_found == 0)
		 {
			 $insert = [
				 'group_name' => $input['group_name'],
			 ];

			 Group::create($insert);
		 }
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

	 public function getUsersF()
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
										 "1"		=>
													 [
														 "column"			=>  "user.user_id",
														 "comparison"	=>	"=",
														 "value"				=>	265,
													 ],
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
			 $user_slug = Auth::user()->user_slug;
		 }
		 $user_query =
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
														 "column"				=>  "user.is_active",
														 "comparison"		=>	"=",
														 "value"				=>	"1",
													 ],*/
										 "2"		=>
													 [
														 "column"				=>  "user.user_slug",
														 "comparison"		=>	"=",
														 "value"				=>	$user_slug,
													 ],
									 ],
		 ];
		 $user = General::Selects($user_query)->first();

		 if(count($user) == 0 ):
			  echo "Not Found";
				exit();
		 else:
				// <!-- USER EXPERTISES
				// Get Expertises Data
				$user_expertises_query =
				[
					"table"			=> "tr_user_expertise",
					"join"			=>
											[
										 		"expertise"	=>
										 						[
																	"statement"	=> "expertise.expertise_id = tr_user_expertise.expertise_id",
																	"type"			=> "join",
																],
											],
					"condition"	=>
											[
												"0"		=>
															[
																"column"			=>  "tr_user_expertise.user_id",
																"comparison"	=>	"=",
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
					$user_endorses_query = General::Selects($user_endorses_query)->get();

					$user_expertise_data  = array(
						"expertise_name"		=> $user_expertise->expertise_name,
						"total_endorse"			=> count($user_endorses_query),
					);
					array_push($user_expertises_data,$user_expertise_data);
				endforeach;
				// USER EXPERTISES -->

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
			// REVIEW -->

			///////////////////
			//// TABS DATA ////
			///////////////////
			//<!--TRAINING EXPERIENCES
			$user_speaking_experiences_query =
			[
				"table"			=> "tr_speaking_experience",
				"join"			=>
										[
											"group"	=>
															[
																"statement"	=> "tr_speaking_experience.group_id = group.group_id",
																"type"			=> "join",
															],
										],
				"condition"	=>
										[
											"0"		=>
														[
															"column"			=>  "tr_speaking_experience.user_id",
															"comparison"	=>	"=",
															"value"				=>	$user->user_id,
														],
										],
			];
			$user_speaking_experiences = General::Selects($user_speaking_experiences_query)->get();

			$user_speaking_experiences_data  = array();
			foreach($user_speaking_experiences as $user_speaking_experience):

				$user_speaking_experience_expertises_query =
				[
					"table"			=> "tr_speaking_experience_expertise",
					"join"			=>
											[
												"expertise"	=>
																[
																	"statement"	=> "expertise.expertise_id = tr_speaking_experience_expertise.expertise_id",
																	"type"			=> "join",
																],
											],
					"condition"	=>
											[
												"0"		=>
															[
																"column"			=>  "tr_speaking_experience_expertise.tr_speaking_experience_id",
																"comparison"	=>	"=",
																"value"				=>	$user_speaking_experience->tr_speaking_experience_id,
															],
											],
				];
				$user_speaking_experience_expertises = General::Selects($user_speaking_experience_expertises_query)->get();

				$user_speaking_experience_expertises_data = array();
				foreach($user_speaking_experience_expertises as $user_speaking_experience_expertise):
					$user_speaking_experience_expertise_data = array(
						"expertise_name"		=>	$user_speaking_experience_expertise->expertise_name,
					);
					array_push($user_speaking_experience_expertises_data,$user_speaking_experience_expertise_data);
				endforeach;

				//SUMMARY TRAINING EXPERIENCES VARIABLE
				$user_speaking_experience_data  = array(
					"speaking_experience_id"					  	=>		$user_speaking_experience->tr_speaking_experience_id,
					"speaking_experience_title"					  =>		$user_speaking_experience->speaking_experience_title,
					"speaking_experience_description"			=>		$user_speaking_experience->speaking_experience_description,
					"speaking_experience_date"					  =>		$user_speaking_experience->speaking_experience_date,
					"company_profile_picture"					  	=>		$user_speaking_experience->group_profile_picture,
					"company_name"											  =>		$user_speaking_experience->group_name,
					"speaking_experience_expertises"			=>		$user_speaking_experience_expertises_data,
				);
				array_push($user_speaking_experiences_data,$user_speaking_experience_data);

			endforeach;
			// TRAINING EXPERIENCES -->

			//<!--WORK EXPERIENCES
			$user_work_experiences_query =
			[
				"table"			=> "tr_work_experience",
				"join"			=>
										[
											"group"	=>
															[
																"statement"	=> "tr_work_experience.group_id = group.group_id",
																"type"			=> "left join",
															],
										],
				"condition"	=>
										[
											"0"		=>
														[
															"column"			=>  "tr_work_experience.user_id",
															"comparison"	=>	"=",
															"value"				=>	$user->user_id,
														],
										],
			];
			$user_work_experiences = General::Selects($user_work_experiences_query)->get();
			// WORK EXPERIENCES -->

			//<!--TRAINING PROGRAMME
			$user_training_programmes_query =
			[
				"table"			=> "tr_training_programme",
				"condition"	=>
										[
											"0"		=>
														[
															"column"			=>  "tr_training_programme.user_id",
															"comparison"	=>	"=",
															"value"				=>	$user->user_id,
														],
										],
			];
			$user_training_programmes = General::Selects($user_training_programmes_query)->get();
			// TRAINING PROGRAMME-->

			//<!--CERTIFICATION
			$user_certifications_query =
			[
				"table"			=> "tr_certification",
				"condition"	=>
										[
											"0"		=>
														[
															"column"			=>  "tr_certification.user_id",
															"comparison"	=>	"=",
															"value"				=>	$user->user_id,
														],
										],
			];
			$user_certifications = General::Selects($user_certifications_query)->get();

			$user_certifications_data  = array();
			foreach($user_certifications as $user_certification):

				$user_certification_expertises_query =
				[
					"table"			=> "tr_certification_expertise",
					"join"			=>
											[
												"expertise"	=>
																[
																	"statement"	=> "expertise.expertise_id = tr_certification_expertise.expertise_id",
																	"type"			=> "join",
																],
											],
					"condition"	=>
											[
												"0"		=>
															[
																"column"			=>  "tr_certification_expertise.tr_certification_id",
																"comparison"	=>	"=",
																"value"				=>	$user_certification->tr_certification_id,
															],
											],
				];
				$user_certification_expertises = General::Selects($user_certification_expertises_query)->get();

				$user_certification_expertises_data = array();
				foreach($user_certification_expertises as $user_certification_expertise):
					$user_certification_expertise_data = array(
						"expertise_name"		=>	$user_certification_expertise->expertise_name,
					);
					array_push($user_certification_expertises_data,$user_certification_expertise_data);
				endforeach;

				//SUMMARY CERTIFICATION VARIABLE
				$user_certification_data  = array(
					"certification_id"					  	=>		$user_certification->tr_certification_id,
					"certification_title"					  =>		$user_certification->certification_title,
					"certification_description"			=>		$user_certification->certification_description,
					"certification_publisher_name"	=>		$user_certification->publisher_name,
					"certification_date"					  =>		$user_certification->certification_date,
					"certification_expertises"			=>		$user_certification_expertises_data,
				);
				array_push($user_certifications_data,$user_certification_data);

			endforeach;
			// CERTIFICATION -->

			//<!--AWARD
			$user_awards_query =
			[
				"table"			=> "tr_award",
				"condition"	=>
										[
											"0"		=>
														[
															"column"			=>  "tr_award.user_id",
															"comparison"	=>	"=",
															"value"				=>	$user->user_id,
														],
										],
			];
			$user_awards = General::Selects($user_awards_query)->get();

			$user_awards_data  = array();
			foreach($user_awards as $user_award):

				$user_award_expertises_query =
				[
					"table"			=> "tr_award_expertise",
					"join"			=>
											[
												"expertise"	=>
																[
																	"statement"	=> "expertise.expertise_id = tr_award_expertise.expertise_id",
																	"type"			=> "join",
																],
											],
					"condition"	=>
											[
												"0"		=>
															[
																"column"			=>  "tr_award_expertise.tr_award_id",
																"comparison"	=>	"=",
																"value"				=>	$user_award->tr_award_id,
															],
											],
				];
				$user_award_expertises = General::Selects($user_award_expertises_query)->get();

				$user_award_expertises_data = array();
				foreach($user_award_expertises as $user_award_expertise):
					$user_award_expertise_data = array(
						"expertise_name"		=>	$user_award_expertise->expertise_name,
					);
					array_push($user_award_expertises_data,$user_award_expertise_data);
				endforeach;

				//SUMMARY AWARD VARIABLE
				$user_award_data  = array(
					"award_id"					  	=>		$user_award->tr_award_id,
					"award_title"					  =>		$user_award->award_title,
					"award_description"			=>		$user_award->award_description,
					"award_publisher_name"	=>		$user_award->publisher_name,
					"award_date"					  =>		$user_award->award_date,
					"award_expertises"			=>		$user_award_expertises_data,
				);
				array_push($user_awards_data,$user_award_data);

			endforeach;
			// AWARD -->

			//SUMMARY TRAINER PROFILING VARIABLE
			$user_data = array(
				"user_id"														=> $user->user_id,
				"name"															=> $user->first_name .' '. $user->last_name,
				"email"															=> $user->email,
				"profile_picture"										=> $user->profile_image,
				"summary"														=> $user->summary,
				"area"															=> $user->area,
				"slug"												  		=> $user->user_slug,
				"languages"													=> $user_languages_data,
				"score"															=> $total_user_review_score_data,
				"expertises"												=> $user_expertises_data,
			);

			//PASSING VARIABLES TO VIEW
			$user_data 														= json_decode(json_encode($user_data), FALSE);
			$user_training_experiences 						= json_decode(json_encode($user_speaking_experiences_data), FALSE); // ARRAY DATA
			$user_work_experiences 								= $user_work_experiences; // OBJECT DATA
			$user_training_programmes							= $user_training_programmes; // OBJECT DATA
			$user_testimonials										= $user_reviews; // OBJECT DATA
			$user_certifications									= json_decode(json_encode($user_certifications_data), FALSE); // ARRAY DATA
			$user_awards													= json_decode(json_encode($user_awards_data), FALSE); // ARRAY DATA

			return view('profile/profile-page')
								->with('grids',$user_data)
								->with('trainingExperiences',$user_training_experiences)
								->with('workExperiences',$user_work_experiences)
								->with('trainingProgrammes',$user_training_programmes)
								->with('testimonials',$user_testimonials)
								->with('certifications',$user_certifications)
								->with('awards',$user_awards)
								->with('gridType',1)
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
