<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\General;
use Illuminate\Http\Request;

use DB;

class GroupController extends Controller {

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
	 public function getGroupProfile()
	 {
		 //$users = User::all();
		 return view('profile.profile-page')->with('gridType',2)->withAuth(1);
	 }

	/**
	* Display user profile page
	*
	* @return Response
	*/
	public function getGroups()
	{
		$groups =	DB::table('providers')
	 					  ->where('providers.profile_picture', '!=', '')
						  ->get();

		$groups_data = array();
		foreach($groups as $group):
				// <!-- GROUP EXPERTISES
				// Get Expertises Data

				$group_expertises =	DB::table('user_skill_nodes')
													 ->join('skills', 'user_skill_nodes.skill_id', '=', 'skills.id')
													 ->where('user_skill_nodes.owner_id', '=', $group->id)
														->where('user_skill_nodes.owner_role_id', '=', 3)
													 ->get();

				$group_expertises_data  = array();
				foreach($group_expertises as $group_expertise):
					// Get Endorse Data
					$group_endorses =	DB::table('user_skill_endorse_nodes')
													 ->where('user_skill_endorse_nodes.user_skill_node_id', '=', $group_expertise->id)
													 ->get();

					$group_expertise_data  = array(
						"expertise_name"		=> $group_expertise->skill_name,
						"total_endorse"			=> count($group_endorses),
					);
					array_push($group_expertises_data,$group_expertise_data);
				endforeach;
				// USER EXPERTISES -->


				//<!-- SPEAKING EXPERIENCE
				$group_speaking_experience =	DB::table('training_experiences')
																		 ->where('training_experiences.owner_id', '=', $group->id)
																		 ->where('training_experiences.owner_role_id', '=', 3)
																		 ->get();
				$total_group_speaking_experience_data = count($group_speaking_experience);
				// SPEAKING EXPERIENCE -->

				//<!-- LANGUAGE PROFIECIENCY

				$group_languages =	DB::table('user_language_nodes')
													 ->join('languages', 'user_language_nodes.language_id' ,'=', 'languages.id')
													 ->where('user_language_nodes.owner_id', '=', $group->id)
													 ->where('user_language_nodes.owner_role_id', '=', 3)
													 ->get();


				$group_languages_data = array();
				foreach($group_languages as $group_language):
					$group_language_data = array(
						"language_name"		=> $group_language->language,
					);
					array_push($group_languages_data,$group_language_data);
				endforeach;
				// LANGUAGE PROFIECIENCY -->

				//<!-- REVIEW
				/*
				$group_reviews_material_facility_query =
				[
					"table"			=> "tr_group",
					"join"			=>
											[
												"tr_review"	=>
																[
																	"statement"	=> "tr_group.user_id = tr_review.user_id",
																	"type"			=> "join",
																],
											],
					"condition"	=>
											[
												"0"		=>
															[
																"column"			=>  "tr_group.group_id",
																"comparison"	=>	"=",
																"value"				=>	$group->group_id,
															],
												"1"		=>
															[
																"column"			=>  "tr_group.group_role_id",
																"comparison"	=>	"=",
																"value"				=>	1,
															],
											],
				];
				$group_reviews_material_facility = General::Selects($group_reviews_material_facility_query)->get();

				$group_reviews_delivery_query =
				[
					"table"			=> "tr_group",
					"join"			=>
											[
												"tr_review"	=>
																[
																	"statement"	=> "tr_group.user_id = tr_review.user_id",
																	"type"			=> "join",
																],
											],
					"condition"	=>
											[
												"0"		=>
															[
																"column"			=>  "tr_group.group_id",
																"comparison"	=>	"=",
																"value"				=>	$group->group_id,
															],
												"1"		=>
															[
																"column"			=>  "tr_group.group_role_id",
																"comparison"	=>	"=",
																"value"				=>	2,
															],
											],
				];
				$group_reviews_delivery = General::Selects($group_reviews_delivery_query)->get();

				// REVIEW MATERIAL FACILITY SCORE
				$flag_material_facility			= 0;
				$material_score 						= 0;
				$facility_score 						= 0;
				$facility_minus_flag 				= 0;
				$material_minus_flag 				= 0;
				$average_material_score 		= 0;
				$average_facility_score			= 0;

				if(count($group_reviews_material_facility) > 0):
				   foreach($group_reviews_material_facility as $group_review_material_facility):
				     $material_score += $group_review_material_facility->material_score;
				     if($group_review_material_facility->material_score == 0):
							 $material_minus_flag++;
					 	 endif;

				     $facility_score += $group_review_material_facility->facility_score;
				     if($group_review_material_facility->facility_score == 0):
							 $facility_minus_flag++;
						 endif;
				     $flag_material_facility++;
				   endforeach;
				   $average_material_score = round((float)$material_score / ($flag_material_facility - $material_minus_flag) ,2);
				   $average_facility_score = round((float)$facility_score / ($flag_material_facility - $facility_minus_flag) ,2);
				endif;

				// REVIEW DELIVERY SCORE
				$flag_delivery							= 0;
				$delivery_score 						= 0;
				$average_delivery_score			= 0;
				if(count($group_reviews_delivery) > 0):
				   foreach($group_reviews_delivery as $group_review_delivery):
				     $delivery_score += $group_review_delivery->delivery_score;
				     $flag_delivery++;
				   endforeach;
				   $average_delivery_score = round((float)$delivery_score / $flag_delivery,2);
				endif;

				$average_group_review_score_data = round((float) ($average_material_score +
															 					 $average_facility_score + $average_delivery_score)
															 				 	 / 3 ,2);

				if($average_material_score == 0):
					$average_material_score = "N/A";
				endif;
				if($average_facility_score == 0):
					$average_facility_score = "N/A";
				endif;
				if($average_delivery_score == 0):
					$average_delivery_score = "N/A";
				endif;
				if($average_group_review_score_data == 0):
					$average_group_review_score_data = "N/A";
				endif;

				$total_group_review_data = $flag_material_facility + $flag_delivery;
				*/
				// REVIEW -->
				$average_material_score = "N/A";
				$average_facility_score = "N/A";
				$average_delivery_score = "N/A";
				$average_group_review_score_data = "N/A";
				$total_group_review_data = 0;

				//CONTACT
				$group_contact 		=	DB::table('contacts')
													 ->where('contacts.contact_owner_id', '=', $group->id)
													 ->where('contacts.contact_owner_role_id', '=', 3)
													 ->get();
				$total_group_following_data = count($group_contact);

				//ALL GROUP DATA
				$group_data = array(
					"user_id"														=> $group->id,
					"name"															=> $group->provider_name,
					"email"															=> $group->email,
					"profile_picture"										=> $group->profile_picture,
					"summary"														=> $group->summary,
					"area"															=> "",
					"slug"												  		=> $group->slug,
					"language"													=> $group_languages_data,
					"material_score"										=> $average_material_score,
					"facility_score"										=> $average_facility_score,
					"delivery_score"										=> $average_delivery_score,
					"score"															=> $average_group_review_score_data,
					"expertises"												=> $group_expertises_data,
					"connection"												=> $total_group_following_data,
					"training"													=> $total_group_speaking_experience_data,
					"review"														=> $total_group_review_data,
				  "view"															=> $group->is_view,
				);
				array_push($groups_data,$group_data);
		endforeach;

		$groups_data_object = json_decode(json_encode($groups_data), FALSE);

		return view('search.grid-list')
			->withGrids($groups_data_object)
			->with('gridType',2);
	}

	/**
	* Display user profile page
	*
	* @return Response
	*/
	public function getGroup($group_slug)
	{
		$group =	DB::table('user_role_nodes')
						 ->join('roles', 'user_role_nodes.role_id', '=', 'roles.id')
						 ->join('providers', 'user_role_nodes.user_id', '=', 'providers.id')
						 ->where('role_id', '=', 3)
						 ->where('providers.slug', '=', $group_slug)
						 ->first();

		if(count($group) == 0 ):
			 echo "Not Found";
			 exit();
		else:
			 // <!-- GROUP EXPERTISES
			 // Get Expertises Data
			 $group_expertises =	DB::table('user_skill_nodes')
													->join('skills', 'user_skill_nodes.skill_id', '=', 'skills.id')
													->where('user_skill_nodes.owner_id', '=', $group->id)
													->where('user_skill_nodes.owner_role_id', '=', 3)
													->get();

			 $group_expertises_data  = array();
			 foreach($group_expertises as $group_expertise):
				 // Get Endorse Data

				 $group_endorses =	DB::table('user_skill_endorse_nodes')
													->where('user_skill_endorse_nodes.user_skill_node_id', '=', $group_expertise->id)
													->get();

				 $group_expertise_data  = array(
					 "expertise_name"			=> $group_expertise->skill_name,
					 "total_endorse"			=> count($group_endorses),
				 );
				 array_push($group_expertises_data,$group_expertise_data);
			 endforeach;
			 // GROUP EXPERTISES -->

			 //<!-- LANGUAGE PROFIECIENCY

			 $group_languages =	DB::table('user_language_nodes')
 												 ->join('languages', 'user_language_nodes.language_id' ,'=', 'languages.id')
 												 ->where('user_language_nodes.owner_id', '=', $group->id)
 												 ->where('user_language_nodes.owner_role_id', '=', 3)
 												 ->get();

			 $group_languages_data = array();
			 foreach($group_languages as $group_language):
				 $group_language_data = array(
					 "language_name"		=> $group_language->language,
				 );
				 array_push($group_languages_data,$group_language_data);
			 endforeach;
			 // LANGUAGE PROFIECIENCY -->

			 //<!-- REVIEW
			 /*
			 $group_reviews_material_facility_query =
			 [
				 "table"			=> "tr_group",
				 "join"			=>
										 [
											 "tr_review"	=>
															 [
																 "statement"	=> "tr_group.user_id = tr_review.user_id",
																 "type"				=> "join",
															 ],
										 ],
				 "condition"	=>
										 [
											 "0"		=>
														 [
															 "column"				=>  "tr_group.group_id",
															 "comparison"		=>	"=",
															 "value"				=>	$group->group_id,
														 ],
											 "1"		=>
														 [
															 "column"				=>  "tr_group.group_role_id",
															 "comparison"		=>	"=",
															 "value"				=>	1,
														 ],
										 ],
			 ];
			 $group_reviews_material_facility = General::Selects($group_reviews_material_facility_query)->get();

			 $group_reviews_delivery_query =
			 [
				 "table"			=> "tr_group",
				 "join"			=>
										 [
											 "tr_review"	=>
															 [
																 "statement"	=> "tr_group.user_id = tr_review.user_id",
																 "type"			=> "join",
															 ],
										 ],
				 "condition"	=>
										 [
											 "0"		=>
														 [
															 "column"			=>  "tr_group.group_id",
															 "comparison"	=>	"=",
															 "value"				=>	$group->group_id,
														 ],
											 "1"		=>
														 [
															 "column"			=>  "tr_group.group_role_id",
															 "comparison"	=>	"=",
															 "value"				=>	2,
														 ],
										 ],
			 ];
			 $group_reviews_delivery = General::Selects($group_reviews_delivery_query)->get();

			 // REVIEW MATERIAL FACILITY SCORE
			 $flag_material_facility			= 0;
			 $material_score 							= 0;
			 $facility_score 							= 0;
			 $facility_minus_flag 				= 0;
			 $material_minus_flag 				= 0;
			 $average_material_score 			= 0;
			 $average_facility_score			= 0;

			 if(count($group_reviews_material_facility) > 0):
					foreach($group_reviews_material_facility as $group_review_material_facility):
						$material_score += $group_review_material_facility->material_score;
						if($group_review_material_facility->material_score == 0):
							$material_minus_flag++;
						endif;

						$facility_score += $group_review_material_facility->facility_score;
						if($group_review_material_facility->facility_score == 0):
							$facility_minus_flag++;
						endif;
						$flag_material_facility++;
					endforeach;
					$average_material_score = round((float)$material_score / ($flag_material_facility - $material_minus_flag) ,2);
					$average_facility_score = round((float)$facility_score / ($flag_material_facility - $facility_minus_flag) ,2);
			 endif;

			 // REVIEW DELIVERY SCORE
			 $flag_delivery							= 0;
			 $delivery_score 						= 0;
			 $average_delivery_score			= 0;
			 if(count($group_reviews_delivery) > 0):
					foreach($group_reviews_delivery as $group_review_delivery):
						$delivery_score += $group_review_delivery->delivery_score;
						$flag_delivery++;
					endforeach;
					$average_delivery_score = round((float)$delivery_score / $flag_delivery,2);
			 endif;

			 $average_group_review_score_data = round((float) ($average_material_score +
																				$average_facility_score + $average_delivery_score)
																				/ 3 ,2);

			 if($average_material_score == 0):
				 $average_material_score = "N/A";
			 endif;
			 if($average_facility_score == 0):
				 $average_facility_score = "N/A";
			 endif;
			 if($average_delivery_score == 0):
				 $average_delivery_score = "N/A";
			 endif;
			 if($average_group_review_score_data == 0):
				 $average_group_review_score_data = "N/A";
			 endif;

			 $total_group_review_data = $flag_material_facility + $flag_delivery;
		   */
			 $average_material_score = "N/A";
			 $average_facility_score = "N/A";
			 $average_delivery_score = "N/A";
			 $average_group_review_score_data = "N/A";
			 $total_group_review_data = 0;
			 // REVIEW -->

		 ///////////////////
		 //// TABS DATA ////
		 ///////////////////
		 //<!--TRAINING EXPERIENCES
		 $group_speaking_experiences =	DB::table('training_experience_program_nodes')
																	->join('training_experiences','training_experience_program_nodes.training_experience_id','=','training_experiences.id')
																	->join('training_program','training_experience_program_nodes.training_program_id','=','training_program.id')
																	->join('providers','training_experiences.provider_id','=','providers.id')
																	->join('corporates','training_experiences.corporate_id','=','corporates.id')
																	->where('training_experiences.owner_id', '=', $group->id)
																	->where('training_experiences.owner_role_id', '=', 3)
																	->get();


		 $group_speaking_experiences_data  = array();
		 foreach($group_speaking_experiences as $group_speaking_experience):

			 //SKILL TRAINING EXPERIENCE
			 $group_speaking_experience_expertises =	DB::table('section_skills')
																								->join('skills','section_skills.skill_id','=','skills.id')
																								->where('section_skills.section_id', '=', 1)
																								->where('section_skills.section_item_id', '=', $group_speaking_experience->training_experience_id)
																								->get();

			 $group_speaking_experience_expertises_data = array();
			 foreach($group_speaking_experience_expertises as $group_speaking_experience_expertise):
				 $group_speaking_experience_expertise_data = array(
					 "expertise_name"		=>	$group_speaking_experience_expertise->skill_name,
				 );
				 array_push($group_speaking_experience_expertises_data,$group_speaking_experience_expertise_data);
			 endforeach;

			 //PHOTO TRAINING EXPERIENCE
			 $group_speaking_experience_photos = DB::table('section_photos')
			                                    ->where('section_photos.section_id', '=', 1)
			                                    ->where('section_photos.section_item_id', '=', $group_speaking_experience->training_experience_id)
			                                    ->get();

			 $group_speaking_experience_photos_data = array();
			 foreach($group_speaking_experience_photos as $group_speaking_experience_photo):
			   $group_speaking_experience_photo_data = array(
			     "photo_name"					=>	$group_speaking_experience_photo->photo_name,
			     "photo_path"					=>	$group_speaking_experience_photo->photo_path,
			     "photo_description"		=>	$group_speaking_experience_photo->photo_description,
			   );
			   array_push($group_speaking_experience_photos_data,$group_speaking_experience_photo_data);
			 endforeach;

			 //VIDEO TRAINING EXPERIENCE
			 $group_speaking_experience_videos = DB::table('section_videos')
			                                    ->where('section_videos.section_id', '=', 1)
			                                    ->where('section_videos.section_item_id', '=', $group_speaking_experience->training_experience_id)
			                                    ->where('section_videos.video_type', '=', "youtube")
			                                    ->get();

			 $group_speaking_experience_videos_data = array();
			 foreach($group_speaking_experience_videos as $group_speaking_experience_video):
			   $group_speaking_experience_video_data = array(
			     "video_name"					=>	$group_speaking_experience_video->video_name,
			     "video_path"					=>	$group_speaking_experience_video->video_path,
			     "video_description"		=>	$group_speaking_experience_video->video_description,
			   );
			   array_push($group_speaking_experience_videos_data,$group_speaking_experience_video_data);
			 endforeach;


			 //SUMMARY TRAINING EXPERIENCES VARIABLE
			 $group_speaking_experience_data  = array(
				 "speaking_experience_id"					  	=>		$group_speaking_experience->id,
				 "speaking_experience_title"					  =>		$group_speaking_experience->training_experience,
				 "speaking_experience_description"			=>		$group_speaking_experience->description,
				 "speaking_experience_start_date"		  =>		$group_speaking_experience->start_date,
				 "speaking_experience_end_date"				=>		$group_speaking_experience->end_date,
				 "company_profile_picture"					  	=>		$group_speaking_experience->corporate_profile_picture,
				 "company_name"											  =>		$group_speaking_experience->corporate_name,
				 "provider_profile_picture"					  =>		$group_speaking_experience->profile_picture,
				 "provider_name"											  =>		$group_speaking_experience->provider_name,
				 "speaking_experience_expertises"			=>		$group_speaking_experience_expertises_data,
				 "speaking_experience_photos"					=>		$group_speaking_experience_photos_data,
				 "speaking_experience_videos"					=>		$group_speaking_experience_videos_data,
				 "training_programme_title"						=>		$group_speaking_experience->training_program_name_id,
			 );
			 array_push($group_speaking_experiences_data,$group_speaking_experience_data);

		 endforeach;
		 // TRAINING EXPERIENCES -->





// TO BE CONTINUED


		 //<!--PROVIDER'S TRAINER
/*
		 $companies_providers_trainers_query =
		 [
			 "table"		=> "user",
			 "join"			=>
									 [
										 "tr_group"	=>
														 [
															 "statement"	=> "user.user_id = tr_group.user_id",
															 "type"				=> "join",
														 ],
									 ],
			 "condition"	=>
									 [
										 "0"		=>
													 [
														 "column"				=>  "tr_group.group_id",
														 "comparison"		=>	"=",
														 "value"				=>	$group->group_id,
													 ],
									 ],
		 ];
		 $companies_providers_trainers = General::Selects($companies_providers_trainers_query)->get();

		 $companies_providers_trainers_data  = array();
		 foreach($companies_providers_trainers as $company_provider_trainer):
			 $group_expertises_query =
			 [
				"table"			=> "tr_user_expertise",
				"join"			=>
										[
											"expertise"	=>
															[
																"statement"		=> "expertise.expertise_id = tr_user_expertise.expertise_id",
																"type"				=> "join",
															],
										],
				"condition"	=>
										[
											"0"		=>
														[
															"column"				=>  "tr_user_expertise.user_id",
															"comparison"		=>	"=",
															"value"					=>	$company_provider_trainer->user_id,
														],
										],
			];
			$group_expertises = General::Selects($group_expertises_query)->get();

			$group_expertises_data  = array();
			foreach($group_expertises as $group_expertise):
					// Get Endorse Data
					$group_endorses_query =
					[
						"table"			=> "tr_endorse",
						"condition"	=>
													[
														"0"		=>
																	[
																		"column"			=>  "tr_endorse.tr_user_expertise_id",
																		"comparison"	=>	"=",
																		"value"				=>	$group_expertise->tr_user_expertise_id,
																	],
													],
					];
					$group_endorses = General::Selects($group_endorses_query)->get();

					$group_expertise_data  = array(
						"expertise_name"			=> $group_expertise->expertise_name,
						"total_endorse"				=> count($group_endorses),
					);
					array_push($group_expertises_data,$group_expertise_data);
				endforeach;

					// Get Featured / Promote Data

					$group_featured_query =
					[
						"table"			=> "tr_featured",
						"condition"	=>
													[
														"0"		=>
																	[
																		"column"			=>  "tr_featured.user_id",
																		"comparison"	=>	"=",
																		"value"				=>	$company_provider_trainer->user_id,
																	],
													],
					];
					$group_featured = General::Selects($group_featured_query)->get();

					$group_featured_chosen = "promote";
					if(count($group_featured_query) > 0):
						$group_featured_chosen = "promoted";
					endif;

					$company_provider_trainer_data = array(
            "user_id"                           => $company_provider_trainer->user_id,
            "user_slug"                         => $company_provider_trainer->user_slug,
            "group_id"                          => $group->group_id,
            "email"                             => $company_provider_trainer->email,
            "summary"                        		=> $company_provider_trainer->summary,
						"initial_name"                      => strtoupper(substr($company_provider_trainer->first_name,0,1))." ".strtoupper(substr($company_provider_trainer->last_name,0,1)),
						"name"                        			=> $company_provider_trainer->first_name." ".$company_provider_trainer->last_name,
            "profile_image"                     => $company_provider_trainer->profile_image,
            "expertises"                        => $group_expertises_data,
            "featured"                          => $group_featured_chosen,
          );

          array_push($companies_providers_trainers_data,$company_provider_trainer_data);

		 endforeach;
		 */
		 // PROVIDER"S TRAINER -->
		 $companies_providers_trainers_data = array();
// END HERE TO BE CONTINUED

		 //<!--TRAINING PROGRAMME

		 $group_training_programs =	DB::table('user_training_program_nodes')
		                              ->join('training_program','user_training_program_nodes.training_program_id','=','training_program.id')
		                              ->where('user_training_program_nodes.owner_id', '=', $group->id)
		                              ->where('user_training_program_nodes.owner_role_id', '=', 3)
		                              ->get();

		 $group_training_programs_data = array();
		 foreach($group_training_programs as $group_training_program):

		   //Learning Outcome
		   $group_training_program_learning_outcomes =
		   DB::table('user_training_program_learning_outcome_nodes')
		   ->join('learning_outcomes','user_training_program_learning_outcome_nodes.learning_outcome_id','=','learning_outcomes.id')
		   ->where('user_training_program_learning_outcome_nodes.group_training_program_id', '=', $group_training_program->id)
		   ->get();

		   $group_training_programs_learning_outcomes_data = array();
		   foreach($group_training_program_learning_outcomes as $group_training_program_learning_outcome):

		     //outcome preferences
		     $group_training_program_learning_outcome_outcome_preferences =
		     DB::table('user_training_program_learning_outcome_outcome_preference_nodes')
		     ->join('outcome_preferences','user_training_program_learning_outcome_outcome_preference_nodes.outcome_preference_id','=','outcome_preferences.id')
		     ->where('user_training_program_learning_outcome_outcome_preference_nodes.group_training_program_learning_outcome_id', '=', $group_training_program_learning_outcome->id)
		     ->get();

		     $group_training_program_learning_outcome_outcome_preferences_data = array();
		     foreach($group_training_program_learning_outcome_outcome_preferences as $group_training_program_learning_outcome_outcome_preference):

		       $group_training_program_learning_outcome_outcome_preference_data = array(
		             "outcome_preference_name" => $group_training_program_learning_outcome_outcome_preference->outcome_preference_name,
		       );
		       array_push($group_training_program_learning_outcome_outcome_preferences_data,$group_training_program_learning_outcome_outcome_preference_data);
		     endforeach;


		     $group_training_programs_learning_outcome_data = array(
		         "learning_outcome_name"				=> $group_training_program_learning_outcome->learning_outcome_name,
		         "outcome_preference_names"		=> $group_training_program_learning_outcome_outcome_preferences_data,
		     );
		     array_push($group_training_programs_learning_outcomes_data,$group_training_programs_learning_outcome_data);
		   endforeach;


		   $group_training_program_data = array(
		       "training_program_id"					=> $group_training_program->id,
		       "training_program_name_id"		=> $group_training_program->training_program_name_id,
		       "learning_outcome_names"			=> $group_training_programs_learning_outcomes_data,
		   );


		   array_push($group_training_programs_data,$group_training_program_data);
		 endforeach;
		 // TRAINING PROGRAMME-->

		 //<!--TESTIMONIAL
		 /*
		 $group_testimonials_query =
		 [
			 "table"			=> "tr_group",
			 "join"				=>
										 [
											 "tr_review"	=>
															 [
																 "statement"	=> "tr_group.user_id = tr_review.user_id",
																 "type"				=> "join",
															 ],
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
															 "column"				=>  "tr_group.group_id",
															 "comparison"		=>	"=",
															 "value"				=>	$group->group_id,
														 ],
											 "1"		=>
														 [
															 "column"				=>  "tr_group.group_role_id",
															 "comparison"		=>	"=",
															 "value"				=>	1,
														 ],
											 "2"		=>
														 [
															 "column"				=>  "tr_review.status",
															 "comparison"		=>	"=",
															 "value"				=>	0,
														 ],
											 "3"		=>
														 [
															 "column"				=>  "tr_review.delivery_score",
															 "comparison"		=>	"=",
															 "value"				=>	0,
														 ],
										 ],
		 ];
		 $group_testimonials = General::Selects($group_testimonials_query)->get();
		 */

		 $group_testimonials = array();
		 // TESTIMONIAL -->

		 //<!--CERTIFICATION
		 $group_certifications =	DB::table('certifications')
		                         ->where('certifications.owner_id', '=', $group->id)
		                         ->where('certifications.owner_role_id', '=', 3)
		                         ->get();

		 $group_certifications_data  = array();
		 foreach($group_certifications as $group_certification):

		   //SKILL CERTIFICATION
		   $group_certification_expertises =	DB::table('section_skills')
		                                    ->join('skills','section_skills.skill_id','=','skills.id')
		                                    ->where('section_skills.section_id', '=', 7)
		                                    ->where('section_skills.section_item_id', '=', $group_certification->id)
		                                    ->get();

		   $group_certification_expertises_data = array();
		   foreach($group_certification_expertises as $group_certification_expertise):
		     $group_certification_expertise_data = array(
		       "expertise_name"		=>	$group_certification_expertise->skill_name,
		     );
		     array_push($group_certification_expertises_data,$group_certification_expertise_data);
		   endforeach;

		   //PHOTO CERTIFICATION
		   $group_certification_photos = DB::table('section_photos')
		                                      ->where('section_photos.section_id', '=', 7)
		                                      ->where('section_photos.section_item_id', '=', $group_certification->id)
		                                      ->get();

		   $group_certification_photos_data = array();
		   foreach($group_certification_photos as $group_certification_photo):
		     $group_certification_photo_data = array(
		       "photo_name"					=>	$group_certification_photo->photo_name,
		       "photo_path"					=>	$group_certification_photo->photo_path,
		       "photo_description"		=>	$group_certification_photo->photo_description,
		     );
		     array_push($group_certification_photos_data,$group_certification_photo_data);
		   endforeach;

		   //VIDEO CERTIFICATION
		   $group_certification_videos = DB::table('section_videos')
		                                ->where('section_videos.section_id', '=', 7)
		                                ->where('section_videos.section_item_id', '=', $group_certification->id)
		                                ->get();

		   $group_certification_videos_data = array();
		   foreach($group_certification_videos as $group_certification_video):
		     $group_certification_video_data = array(
		       "video_name"					=>	$group_certification_video->video_name,
		       "video_path"					=>	$group_certification_video->video_path,
		       "video_description"		=>	$group_certification_video->video_description,
		     );
		     array_push($group_certification_videos_data,$group_certification_video_data);
		   endforeach;

		   //SUMMARY CERTIFICATION VARIABLE
		   $group_certification_data  = array(
		     "certification_id"					  		=>		$group_certification->id,
		     "certification_title"					  =>		$group_certification->title,
		     "certification_description"			=>		$group_certification->description,
		     "certification_publisher_name"		=>		$group_certification->publisher,
		     "certification_date"					  	=>		$group_certification->published_date,
		     "certification_expertises"				=>		$group_certification_expertises_data,
		     "certification_photos"						=>		$group_certification_photos_data,
		     "certification_videos"						=>		$group_certification_videos_data
		   );
		   array_push($group_certifications_data,$group_certification_data);

		 endforeach;
		 // CERTIFICATION -->

		 //<!--AWARD
		 $group_awards =	DB::table('awards')
		                 ->where('awards.owner_id', '=', $group->id)
		                 ->where('awards.owner_role_id', '=', 3)
		                 ->get();

		 $group_awards_data  = array();
		 foreach($group_awards as $group_award):

		   //SKILL award
		   $group_award_expertises =	DB::table('section_skills')
		                              ->join('skills','section_skills.skill_id','=','skills.id')
		                              ->where('section_skills.section_id', '=', 8)
		                              ->where('section_skills.section_item_id', '=', $group_award->id)
		                              ->get();

		   $group_award_expertises_data = array();
		   foreach($group_award_expertises as $group_award_expertise):
		     $group_award_expertise_data = array(
		       "expertise_name"		=>	$group_award_expertise->skill_name,
		     );
		     array_push($group_award_expertises_data,$group_award_expertise_data);
		   endforeach;

		   //PHOTO award
		   $group_award_photos = DB::table('section_photos')
		                        ->where('section_photos.section_id', '=', 8)
		                        ->where('section_photos.section_item_id', '=', $group_award->id)
		                        ->get();

		   $group_award_photos_data = array();
		   foreach($group_award_photos as $group_award_photo):
		     $group_award_photo_data = array(
		       "photo_name"					=>	$group_award_photo->photo_name,
		       "photo_path"					=>	$group_award_photo->photo_path,
		       "photo_description"		=>	$group_award_photo->photo_description,
		     );
		     array_push($group_award_photos_data,$group_award_photo_data);
		   endforeach;

		   //VIDEO award
		   $group_award_videos = DB::table('section_videos')
		                        ->where('section_videos.section_id', '=', 8)
		                        ->where('section_videos.section_item_id', '=', $group_award->id)
		                        ->get();

		   $group_award_videos_data = array();
		   foreach($group_award_videos as $group_award_video):
		     $group_award_video_data = array(
		       "video_name"					=>	$group_award_video->video_name,
		       "video_path"					=>	$group_award_video->video_path,
		       "video_description"		=>	$group_award_video->video_description,
		     );
		     array_push($group_award_videos_data,$group_award_video_data);
		   endforeach;

		   //SUMMARY award VARIABLE
		   $group_award_data  = array(
		     "award_id"					  		=>		$group_award->id,
		     "award_title"					  =>		$group_award->title,
		     "award_description"			=>		$group_award->description,
		     "award_publisher_name"		=>		$group_award->publisher,
		     "award_date"					  	=>		$group_award->published_date,
		     "award_expertises"				=>		$group_award_expertises_data,
		     "award_photos"						=>		$group_award_photos_data,
		     "award_videos"						=>		$group_award_videos_data
		   );
		   array_push($group_awards_data,$group_award_data);

		 endforeach;
		 // AWARD -->

		 //SUMMARY PROVIDER PROFILING VARIABLE
		 $group_data = array(
			 "user_id"														=> $group->id,
			 "name"																=> $group->provider_name,
			 "email"															=> $group->email,
			 "profile_picture"										=> $group->profile_picture,
			 "summary"														=> $group->summary,
			 "area"																=> "",
			 "slug"												  			=> $group->slug,
			 "languages"													=> $group_languages_data,
			 "material_score"											=> $average_material_score,
			 "facility_score"											=> $average_facility_score,
			 "delivery_score"											=> $average_delivery_score,
			 "score"															=> $average_group_review_score_data,
			 "expertises"													=> $group_expertises_data,
			 "review"															=> $total_group_review_data,
		 );

		 //PASSING VARIABLES TO VIEW
		 $group_data 														= json_decode(json_encode($group_data), FALSE); // ARRAY DATA
		 $group_training_experiences 						= json_decode(json_encode($group_speaking_experiences_data), FALSE); // ARRAY DATA
		 $group_trainers 												= json_decode(json_encode($companies_providers_trainers_data), FALSE); // ARRAY DATA
		 $group_training_programmes							= json_decode(json_encode($group_training_programs_data), FALSE); // ARRAY DATA
		 $group_testimonials										= json_decode(json_encode($group_testimonials), FALSE); // OBJECT DATA
		 $group_certifications									= json_decode(json_encode($group_certifications_data), FALSE); // ARRAY DATA
		 $group_awards													= json_decode(json_encode($group_awards_data), FALSE); // ARRAY DATA

		 return view('profile/profile-page')
							 ->with('grids',$group_data)
							 ->with('trainingExperiences',$group_training_experiences)
							 ->with('trainers',$group_trainers)
							 ->with('trainingProgrammes',$group_training_programmes)
							 ->with('testimonials',$group_testimonials)
							 ->with('certifications',$group_certifications)
							 ->with('awards',$group_awards)
							 ->with('gridType',1)
							 ->with('role',2);
	 endif;

		return view('profile.profile-page')->with('gridType',2)->with('role',2);
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
