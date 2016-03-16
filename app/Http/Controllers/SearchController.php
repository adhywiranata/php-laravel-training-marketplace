<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Provider;
use Illuminate\Http\Request;
use DB;

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
	public function find_trainers(Request $request)
	{
		//print preg_replace("/$words/i", "<b>$0</b>", $text);

		$users = User::join('user_role_nodes', 'user_role_nodes.user_id', '=', 'users.id')
				->where('role_id', '=', 2)				
	            ->where('users.is_verified', '=', 1)
	            ->where('users.first_name', '!=', '')
	            ->whereIn('users.id', function($query) use ($request) {

	            	$query->select('users.id')
	            		->from('users')
	            		->join('user_skill_nodes', function($join){
	            			$join->on('user_skill_nodes.owner_id', '=', 'users.id')
	            				->on('user_skill_nodes.owner_role_id', '=', DB::raw("2"));
	            		})
						->join('skills', 'skills.id', '=', 'user_skill_nodes.skill_id')
						->join('user_training_program_nodes', function($join){
	            			$join->on('user_training_program_nodes.owner_id', '=', 'users.id')
	            				->on('user_training_program_nodes.owner_role_id', '=', DB::raw("2"));
	            		})
	            		->join('training_program', 'training_program.id', '=', 'user_training_program_nodes.training_program_id');


	            	$keywords = explode('+', $request->keywords);

					//Search by Keywords
					foreach ($keywords as $row) {
				    	$query->orWhere('first_name', 'like', '%'.$row.'%')
				    		->orWhere('last_name', 'like', '%'.$row.'%')
				    		->orWhere('job_title', 'like', '%'.$row.'%')
				    		->orWhere('job_function', 'like', '%'.$row.'%')
				    		->orWhere('job_seniority_level', 'like', '%'.$row.'%')
				    		->orWhere('skill_name', 'like', '%'.$row.'%')
				    		->orWhere('training_program_name_en', 'like', '%'.$row.'%')
				    		->orWhere('training_program_name_id', 'like', '%'.$row.'%');
				    }
	            });

		if($request->budget != ''){
			$users = $users->where('users.mandays_fee', '<=', $request->budget);
		}
				
		$users = $users->where('users.service_area', 'like', '%'.$request->location.'%')
				->where(function($query) use ($request) {
					$method = explode('+', $request->method);

					foreach ($method as $row) {
						$query->orWhere('training_method', 'like', '%'.$row.'%');
					}
				})
				->where(function($query) use ($request) {
					$style = explode('+', $request->style);

					foreach ($style as $row) {
						$query->orWhere('training_style', 'like', '%'.$row.'%');
					}
				})
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
	         	"user_id"			=> $user->id,
	         	"name"				=> $user->first_name . ' ' . $user->last_name,
	         	"email"				=> $user->email,
	         	"profile_picture"	=> $user->profile_picture,
	         	"summary"			=> $user->summary,
	         	"area"				=> $user->service_area,
	         	"slug"				=> $user->slug,
	         	"language"			=> $user_languages_data,
	         	"score"				=> $average_user_review_score_data,
	         	"expertises"		=> $user_expertises_data,
	         	"connection"		=> $total_user_connection_data,
	         	"training"			=> $total_user_speaking_experience_data,
	         	"review"			=> $total_user_review_data,
	         	"view"				=> $user->is_view,
	       	);
	       	array_push($users_data,$user_data);
	   	endforeach;

		$users_data_object = json_decode(json_encode($users_data), FALSE);

	   	return view('search.grid-list')
	     	->withGrids($users_data_object)
	     	->with('gridType',1);
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
	public function find_providers(Request $request)
	{
		$groups =	Provider::where('providers.profile_picture', '!=', '')
	 				->where('providers.is_verified', '=', 1)
	 				->whereIn('providers.id', function($query) use ($request) {

		            	$query->select('providers.id')
		            		->from('providers')
		            		->join('user_skill_nodes', function($join){
		            			$join->on('user_skill_nodes.owner_id', '=', 'providers.id')
		            				->on('user_skill_nodes.owner_role_id', '=', DB::raw("3"));
		            		})
							->join('skills', 'skills.id', '=', 'user_skill_nodes.skill_id');
							/*->join('user_training_program_nodes', function($join){
		            			$join->on('user_training_program_nodes.owner_id', '=', 'providers.id')
		            				->on('user_training_program_nodes.owner_role_id', '=', DB::raw("3"));
		            		})*/
		            		//->join('training_program', 'training_program.id', '=', 'user_training_program_nodes.training_program_id');


		            	$keywords = explode('+', $request->keywords);

						//Search by Keywords
						foreach ($keywords as $row) {
					    	$query->orWhere('provider_name', 'like', '%'.$row.'%')
					    		->orWhere('skill_name', 'like', '%'.$row.'%');
					    		//->orWhere('training_program_name_en', 'like', '%'.$row.'%')
					    		//->orWhere('training_program_name_id', 'like', '%'.$row.'%');
					    }
		            });

		if($request->budget != ''){
			$groups = $groups->where('providers.mandays_fee', '<=', $request->budget);
		}

		$groups = $groups->where('providers.service_area', 'like', '%'.$request->location.'%')
					->where(function($query) use ($request) {
						$method = explode('+', $request->method);

						foreach ($method as $row) {
							$query->orWhere('training_method', 'like', '%'.$row.'%');
						}
					})
					->where(function($query) use ($request) {
						$style = explode('+', $request->style);

						foreach ($style as $row) {
							$query->orWhere('training_style', 'like', '%'.$row.'%');
						}
					})
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
				"user_id"			=> $group->id,
				"name"				=> $group->provider_name,
				"email"				=> $group->email,
				"profile_picture"	=> $group->profile_picture,
				"summary"			=> $group->summary,
				"area"				=> "",
				"slug"				=> $group->slug,
				"language"			=> $group_languages_data,
				"material_score"	=> $average_material_score,
				"facility_score"	=> $average_facility_score,
				"delivery_score"	=> $average_delivery_score,
				"score"				=> $average_group_review_score_data,
				"expertises"		=> $group_expertises_data,
				"connection"		=> $total_group_following_data,
				"training"			=> $total_group_speaking_experience_data,
				"review"			=> $total_group_review_data,
			  	"view"				=> $group->is_view,
			);
			array_push($groups_data,$group_data);
		endforeach;

		$groups_data_object = json_decode(json_encode($groups_data), FALSE);

		return view('search.grid-list')
			->withGrids($groups_data_object)
			->with('gridType',2);
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
