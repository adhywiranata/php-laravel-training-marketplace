<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\General;
use Illuminate\Http\Request;

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
		$groups_query =
		[
			"table"			=> "group",
			"condition"	=>
									[
										"0"		=>
													[
														"column"			=>  "group.group_type_id",
														"comparison"	=>	"=",
														"value"				=>	2,
													],
										"1"		=>
													[
														"column"			=>  "group.group_profile_picture",
														"comparison"	=>	"!=",
														"value"				=>	"",
													],
										"2"		=>
													[
														"column"			=>  "group.group_profile_picture",
														"comparison"	=>	"!=",
														"value"				=>	"default.png",
													],
/*										"3"		=>
													[
														"column"			=>  "group.group_profile_picture",
														"comparison"	=>	"!=",
														"value"				=>	"spqs-logo-tagline.png",
													],*/
									],
		];
		$groups = General::Selects($groups_query)->get();

		$groups_data = array();
		foreach($groups as $group):
				// <!-- GROUP EXPERTISES
				// Get Expertises Data
				$group_expertises_query =
				[
					"table"			=> "tr_group_expertise",
					"join"			=>
											[
												"expertise"	=>
																[
																	"statement"	=> "expertise.expertise_id = tr_group_expertise.expertise_id",
																	"type"			=> "join",
																],
											],
					"condition"	=>
											[
												"0"		=>
															[
																"column"			=>  "tr_group_expertise.group_id",
																"comparison"	=>	"=",
																"value"				=>	$group->group_id,
															],
											],
				];
				$group_expertises = General::Selects($group_expertises_query)->get();

				$group_expertises_data  = array();
				foreach($group_expertises as $group_expertise):
					// Get Endorse Data
					$group_endorses_query =
					[
						"table"			=> "tr_group_endorse",
						"condition"	=>
												[
													"0"		=>
																[
																	"column"			=>  "tr_group_endorse.tr_group_expertise_id",
																	"comparison"	=>	"=",
																	"value"				=>	$group_expertise->tr_group_expertise_id,
																],
												],
					];
					$group_endorses = General::Selects($group_endorses_query)->get();

					$group_expertise_data  = array(
						"expertise_name"		=> $group_expertise->expertise_name,
						"total_endorse"			=> count($group_endorses),
					);
					array_push($group_expertises_data,$group_expertise_data);
				endforeach;
				// USER EXPERTISES -->

				//<!-- SPEAKING EXPERIENCE
				$group_speaking_experience_query =
				[
					"table"		 	=> "tr_group_speaking_experience",
					"condition"	=>
											 [
												"0"		=>
															[
																"column"			  =>  "tr_group_speaking_experience.group_id",
																"comparison"	  =>	"=",
																"value"					=>	$group->group_id,
															],
											 ],
				];
				$group_speaking_experience = General::Selects($group_speaking_experience_query)->get();
				$total_group_speaking_experience_data = count($group_speaking_experience);
				// SPEAKING EXPERIENCE -->

				//<!-- LANGUAGE PROFIECIENCY
				$group_languages_query =
				[
					"table"			=> "tr_group",
					"join"			=>
											[
												"tr_language"	=>
																[
																	"statement"	=> "tr_group.user_id = tr_language.user_id",
																	"type"			=> "join",
																],
											],
					"condition"	=>
											[
												"0"		=>
															[
																"column"			=>  "tr_group.group_role_id",
																"comparison"	=>	"=",
																"value"				=>	2,
															],
												"1"		=>
															[
																"column"			=>  "tr_group.group_id",
																"comparison"	=>	"=",
																"value"				=>	$group->group_id,
															],
											],
				];
				$group_languages = General::Selects($group_languages_query)->groupBy('language_code')->get();

				$group_languages_data = array();
				foreach($group_languages as $group_language):
					$group_language_data = array(
						"language_name"		=> $group_language->language_code,
					);
					array_push($group_languages_data,$group_language_data);
				endforeach;
				// LANGUAGE PROFIECIENCY -->

				//<!-- REVIEW
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
				// REVIEW -->

				//CONNECTION
				$group_followings_query =
				[
					"table"			=> "tr_follow_group",
					"condition"	=>
											[
												"0"		=>
															[
																"column"			=>  "tr_follow_group.group_id",
																"comparison"	=>	"=",
																"value"				=>	$group->group_id,
															],
											],
				];
				$group_followings 					= General::Selects($group_followings_query)->get();
				$total_group_following_data = count($group_followings);

				//ALL GROUP DATA
				$group_data = array(
					"user_id"														=> $group->group_id,
					"name"															=> $group->group_name,
					"email"															=> $group->email,
					"profile_picture"										=> $group->group_profile_picture,
					"summary"														=> $group->summary,
					"area"															=> "",
					"slug"												  		=> $group->group_slug,
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
		$group_query =
		[
			"table"			=> "group",
			"condition"	=>
									[
										"0"		=>
													[
														"column"				=>  "group.group_type_id",
														"comparison"		=>	"=",
														"value"					=>	2,
													],
										"1"		=>
													[
														"column"				=>  "group.group_slug",
														"comparison"		=>	"=",
														"value"					=>	$group_slug,
													],
									],
		];
		$group = General::Selects($group_query)->first();

		if(count($group) == 0 ):
			 echo "Not Found";
			 exit();
		else:
			 // <!-- GROUP EXPERTISES
			 // Get Expertises Data
			 $group_expertises_query =
			 [
				 "table"			=> "tr_group_expertise",
				 "join"			=>
										 [
											 "expertise"	=>
															 [
																 "statement"	=> "expertise.expertise_id = tr_group_expertise.expertise_id",
																 "type"				=> "join",
															 ],
										 ],
				 "condition"	=>
										 [
											 "0"		=>
														 [
															 "column"				=>  "tr_group_expertise.group_id",
															 "comparison"		=>	"=",
															 "value"				=>	$group->group_id,
														 ],
										 ],
			 ];
			 $group_expertises = General::Selects($group_expertises_query)->get();

			 $group_expertises_data  = array();
			 foreach($group_expertises as $group_expertise):
				 // Get Endorse Data
				 $group_endorses_query =
				 [
					 "table"			=> "tr_group_endorse",
					 "condition"	=>
											 [
												 "0"		=>
															 [
																 "column"				=>  "tr_group_endorse.tr_group_expertise_id",
																 "comparison"		=>	"=",
																 "value"				=>	$group_expertise->tr_group_expertise_id,
															 ],
											 ],
				 ];
				 $group_endorses_query = General::Selects($group_endorses_query)->get();

				 $group_expertise_data  = array(
					 "expertise_name"			=> $group_expertise->expertise_name,
					 "total_endorse"			=> count($group_endorses_query),
				 );
				 array_push($group_expertises_data,$group_expertise_data);
			 endforeach;
			 // GROUP EXPERTISES -->

			 //<!-- LANGUAGE PROFIECIENCY
			 $group_languages_query =
			 [
				 "table"			=> "tr_group",
				 "join"			=>
										 [
											 "tr_language"	=>
															 [
																 "statement"	=> "tr_group.user_id = tr_language.user_id",
																 "type"			=> "join",
															 ],
										 ],
				 "condition"	=>
										 [
											 "0"		=>
														 [
															 "column"			=>  "tr_group.group_role_id",
															 "comparison"	=>	"=",
															 "value"				=>	2,
														 ],
											 "1"		=>
														 [
															 "column"			=>  "tr_group.group_id",
															 "comparison"	=>	"=",
															 "value"				=>	$group->group_id,
														 ],
										 ],
			 ];
			 $group_languages = General::Selects($group_languages_query)->groupBy('language_code')->get();

			 $group_languages_data = array();
			 foreach($group_languages as $group_language):
				 $group_language_data = array(
					 "language_name"		=> $group_language->language_code,
				 );
				 array_push($group_languages_data,$group_language_data);
			 endforeach;
			 // LANGUAGE PROFIECIENCY -->

			 //<!-- REVIEW
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
		   // REVIEW -->

		 ///////////////////
		 //// TABS DATA ////
		 ///////////////////
		 //<!--TRAINING EXPERIENCES
		 $group_speaking_experiences_query =
		 [
			 "table"		=> "tr_group_speaking_experience",
			 "join"			=>
									 [
										 "group"	=>
														 [
															 "statement"	=> "tr_group_speaking_experience.group_id = group.group_id",
															 "type"			=> "join",
														 ],
										 "user"	=>
														 [
															 "statement"	=> "tr_group_speaking_experience.user_id = user.user_id",
															 "type"			=> "left join",
														 ],
									 ],
			 "condition"	=>
									 [
										 "0"		=>
													 [
														 "column"			=>  "tr_group_speaking_experience.provider_id",
														 "comparison"	=>	"=",
														 "value"				=>	$group->group_id,
													 ],
									 ],
		 ];
		 $group_speaking_experiences = General::Selects($group_speaking_experiences_query)->get();

		 $group_speaking_experiences_data  = array();
		 foreach($group_speaking_experiences as $group_speaking_experience):

			 $group_speaking_experience_expertises_query =
			 [
				 "table"			=> "tr_group_speaking_experience_expertise",
				 "join"			=>
										 [
											 "expertise"	=>
															 [
																 "statement"	=> "expertise.expertise_id = tr_group_speaking_experience_expertise.expertise_id",
																 "type"				=> "join",
															 ],
										 ],
				 "condition"	=>
										 [
											 "0"		=>
														 [
															 "column"			=>  "tr_group_speaking_experience_expertise.tr_group_speaking_experience_id",
															 "comparison"	=>	"=",
															 "value"				=>	$group_speaking_experience->tr_group_speaking_experience_id,
														 ],
										 ],
			 ];
			 $group_speaking_experience_expertises = General::Selects($group_speaking_experience_expertises_query)->get();

			 $group_speaking_experience_expertises_data = array();
			 foreach($group_speaking_experience_expertises as $group_speaking_experience_expertise):
				 $group_speaking_experience_expertise_data = array(
					 "expertise_name"		=>	$group_speaking_experience_expertise->expertise_name,
				 );
				 array_push($group_speaking_experience_expertises_data,$group_speaking_experience_expertise_data);
			 endforeach;

			 //SUMMARY TRAINING EXPERIENCES VARIABLE
			 $group_speaking_experience_data  = array(
				 "speaking_experience_id"					  		=>		$group_speaking_experience->tr_group_speaking_experience_id,
				 "speaking_experience_title"					  =>		$group_speaking_experience->group_speaking_experience_title,
				 "speaking_experience_description"			=>		$group_speaking_experience->group_speaking_experience_description,
				 "speaking_experience_date"					  	=>		$group_speaking_experience->group_speaking_experience_date,
				 "company_profile_picture"					  	=>		$group_speaking_experience->group_profile_picture,
				 "company_name"					  							=>		$group_speaking_experience->group_name,
				 "speaking_experience_expertises"				=>		$group_speaking_experience_expertises_data,
			 );
			 array_push($group_speaking_experiences_data,$group_speaking_experience_data);

		 endforeach;
		 // TRAINING EXPERIENCES -->

		 //<!--PROVIDER'S TRAINER
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
		 // PROVIDER"S TRAINER -->

		 //<!--TRAINING PROGRAMME
		 $group_training_programmes_query =
		 [
			 //"select"			=> "* tr_group_training_programme.group_training_programme_title AS training_programme_title",
			 "table"			=> "tr_group_training_programme",
			 "condition"	=>
									 [
										 "0"		=>
													 [
														 "column"				=>  "tr_group_training_programme.group_id",
														 "comparison"		=>	"=",
														 "value"				=>	$group->group_id,
													 ],
									 ],
		 ];
		 $group_training_programmes = General::Selects($group_training_programmes_query)->get();
		 $group_training_programmes_data = array();
		 foreach($group_training_programmes as $group_training_programme):
		 		$group_training_programme_data = array(
					"tr_training_programme_id"	 				=> $group_training_programme->tr_group_training_programme_id,
					"group_id"	 								 				=> $group_training_programme->group_id,
					"user_id"	 									 				=> $group_training_programme->user_id,
					"training_programme_title"	 				=> $group_training_programme->group_training_programme_title,
				);
				array_push($group_training_programmes_data,$group_training_programme_data);
		 endforeach;
		 // TRAINING PROGRAMME-->

		 //<!--TESTIMONIAL
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



		 // TESTIMONIAL -->

		 //<!--CERTIFICATION
		 $group_certifications_query =
		 [
			 "table"			=> "tr_group_certification",
			 "condition"	=>
									 [
										 "0"		=>
													 [
														 "column"				=>  "tr_group_certification.group_id",
														 "comparison"		=>	"=",
														 "value"				=>	$group->group_id,
													 ],
									 ],
		 ];
		 $group_certifications = General::Selects($group_certifications_query)->get();

		 $group_certifications_data  = array();
		 foreach($group_certifications as $group_certification):

			 $group_certification_expertises_query =
			 [
				 "table"			=> "tr_group_certification_expertise",
				 "join"			=>
										 [
											 "expertise"	=>
															 [
																 "statement"	=> "expertise.expertise_id = tr_group_certification_expertise.expertise_id",
																 "type"				=> "join",
															 ],
										 ],
				 "condition"	=>
										 [
											 "0"		=>
														 [
															 "column"				=>  "tr_group_certification_expertise.tr_group_certification_id",
															 "comparison"		=>	"=",
															 "value"				=>	$group_certification->tr_group_certification_id,
														 ],
										 ],
			 ];
			 $group_certification_expertises = General::Selects($group_certification_expertises_query)->get();

			 $group_certification_expertises_data = array();
			 foreach($group_certification_expertises as $group_certification_expertise):
				 $group_certification_expertise_data = array(
					 "expertise_name"		=>	$group_certification_expertise->expertise_name,
				 );
				 array_push($group_certification_expertises_data,$group_certification_expertise_data);
			 endforeach;

			 //SUMMARY CERTIFICATION VARIABLE
			 $group_certification_data  = array(
				 "certification_id"					  		=>		$group_certification->tr_group_certification_id,
				 "certification_title"					  =>		$group_certification->group_certification_title,
				 "certification_description"			=>		$group_certification->group_certification_description,
				 "certification_publisher_name"		=>		$group_certification->group_publisher_name,
				 "certification_date"					  	=>		$group_certification->group_certification_date,
				 "certification_expertises"				=>		$group_certification_expertises_data,
			 );
			 array_push($group_certifications_data,$group_certification_data);

		 endforeach;
		 // CERTIFICATION -->

		 //<!--AWARD
		 $group_awards_query =
		 [
			 "table"			=> "tr_group_award",
			 "condition"	=>
									 [
										 "0"		=>
													 [
														 "column"				=>  "tr_group_award.group_id",
														 "comparison"		=>	"=",
														 "value"				=>	$group->group_id,
													 ],
									 ],
		 ];
		 $group_awards = General::Selects($group_awards_query)->get();

		 $group_awards_data  = array();
		 foreach($group_awards as $group_award):

			 $group_award_expertises_query =
			 [
				 "table"		=> "tr_group_award_expertise",
				 "join"			=>
										 [
											 "expertise"	=>
															 [
																 "statement"	=> "expertise.expertise_id = tr_group_award_expertise.expertise_id",
																 "type"				=> "join",
															 ],
										 ],
				 "condition"	=>
										 [
											 "0"		=>
														 [
															 "column"				=>  "tr_group_award_expertise.tr_group_award_id",
															 "comparison"		=>	"=",
															 "value"				=>	$group_award->tr_group_award_id,
														 ],
										 ],
			 ];
			 $group_award_expertises = General::Selects($group_award_expertises_query)->get();

			 $group_award_expertises_data = array();
			 foreach($group_award_expertises as $group_award_expertise):
				 $group_award_expertise_data = array(
					 "expertise_name"		=>	$group_award_expertise->expertise_name,
				 );
				 array_push($group_award_expertises_data,$group_award_expertise_data);
			 endforeach;

			 //SUMMARY AWARD VARIABLE
			 $user_award_data  = array(
				 "award_id"					  		=>		$group_award->tr_group_award_id,
				 "award_title"					  =>		$group_award->group_award_title,
				 "award_description"			=>		$group_award->group_award_description,
				 "award_publisher_name"		=>		$group_award->group_publisher_name,
				 "award_date"					  	=>		$group_award->group_award_date,
				 "award_expertises"				=>		$group_award_expertises_data,
			 );
			 array_push($group_awards_data,$group_award_data);

		 endforeach;
		 // AWARD -->

		 //SUMMARY PROVIDER PROFILING VARIABLE
		 $group_data = array(
			 "user_id"														=> $group->group_id,
			 "name"																=> $group->group_name,
			 "email"															=> $group->email,
			 "profile_picture"										=> $group->group_profile_picture,
			 "summary"														=> $group->summary,
			 "area"																=> "",
			 "slug"												  			=> $group->group_slug,
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
		 $group_training_programmes							= json_decode(json_encode($group_training_programmes_data), FALSE); // ARRAY DATA
		 $group_testimonials										= $group_testimonials; // OBJECT DATA
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
