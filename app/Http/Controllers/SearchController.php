<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\General;
use Illuminate\Http\Request;

class SearchController extends Controller {

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
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function find_trainers()
	{
		$users_query =
		[
			"table"			=> "user",
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
														"column"			=>  "user.is_active",
														"comparison"	=>	"=",
														"value"				=>	"1",
													],
										"2"		=>
													[
														"column"			=>  "user.first_name",
														"comparison"	=>	"!=",
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
					"join"			=>
											[
										 		"expertise"	=>
										 						[
																	"statement"	=> "expertise.expertise_id = tr_user_expertise.expertise_id",
																	"type"			=> "left join",
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

				//<!-- SPEAKING EXPERIENCE EXPERTISES
				$user_speaking_experience_expertises_query =
				[
					"table"			=> "tr_speaking_experience",
					"join"			=>
											[
										 		"tr_speaking_experience_expertise"	=>
										 						[
																	"statement"	=> "tr_speaking_experience_expertise.tr_speaking_experience_id = tr_speaking_experience.tr_speaking_experience_id",
																	"type"			=> "left join",
																],
												"expertise"	=>
										 						[
																	"statement"	=> "expertise.expertise_id = tr_speaking_experience_expertise.expertise_id",
																	"type"			=> "left join",
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
				$user_speaking_experience_expertises = General::Selects($user_speaking_experience_expertises_query)->get();

				$user_speaking_experience_expertises_data  = array();
				foreach($user_speaking_experience_expertises as $user_speaking_experience_expertise):
					$user_speaking_experience_expertise_data  = array(
						"expertise_name"		=> $user_speaking_experience_expertise->expertise_name,
					);
					array_push($user_speaking_experience_expertises_data,$user_speaking_experience_expertise_data);
				endforeach;
				// SPEAKING EXPERIENCE EXPERTISES -->

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
					$total_user_review_score_data 			= "N/A";
				else:
					$total_user_review_score_data 			= $score;
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
					"user_id"														=> $user->user_id,
					"name"															=> $user->first_name . ' ' . $user->last_name,
					"email"															=> $user->email,
					"summary"														=> $user->summary,
					"area"															=> $user->area,
					"slug"												  		=> $user->user_slug,
					"language"													=> $user_languages_data,
					"score"															=> $total_user_review_score_data,
					"expertises"												=> $user_expertises_data,
					"connection"												=> $total_user_connection_data,
					"review"														=> $total_user_review_data,
				);
				array_push($users_data,$user_data);
		endforeach;

		$users_data_object = json_decode(json_encode($users_data), FALSE);

		return view('search.grid-list')
			->withGridList($users_data_object)
			->withGridType(1);
	}

	/**
	 * Display the training need analysis as an step-by-step search.
	 *
	 * @return View
	 */
	public function trainingNeedsAnalysis()
	{
		return view('search.training-needs-analysis');
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function find_providers()
	{
		return view('search.provider-list');
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
