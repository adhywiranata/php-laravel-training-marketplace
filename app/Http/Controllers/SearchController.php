<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Provider;
use App\Models\TrainingObjective;
use App\Models\ObjectiveSubObjectiveNode;
use App\Models\JobNode;
use App\Models\SubObjectiveJobFunctionSubCategoryNode;
use App\Models\IndustrySubCategoryNode;
use App\Models\JobSeniorityLevel;
use App\Models\Industrie;


use Illuminate\Http\Request;
use DB;
use Input;

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
	            		->leftJoin('user_skill_nodes', function($join){
	            			$join->on('user_skill_nodes.owner_id', '=', 'users.id')
	            				->on('user_skill_nodes.owner_role_id', '=', DB::raw("2"));
	            		})
						->leftJoin('skills', 'skills.id', '=', 'user_skill_nodes.skill_id')
						->leftJoin('user_training_program_nodes', function($join){
	            			$join->on('user_training_program_nodes.owner_id', '=', 'users.id')
	            				->on('user_training_program_nodes.owner_role_id', '=', DB::raw("2"));
	            		})
	            		->leftJoin('training_program', 'training_program.id', '=', 'user_training_program_nodes.training_program_id');


	            	$keywords = explode('+', $request->keywords);

					//Search by Keywords
					foreach ($keywords as $row) {
				    	$query = $query->orWhere('first_name', 'like', '%'.$row.'%')
				    		->orWhere('last_name', 'like', '%'.$row.'%')
				    		->orWhere('job_title', 'like', '%'.$row.'%')
				    		->orWhere('job_function', 'like', '%'.$row.'%')
				    		->orWhere('job_seniority_level', 'like', '%'.$row.'%')
				    		->orWhere('skill_name', 'like', '%'.$row.'%')
				    		->orWhere('training_program_name_en', 'like', '%'.$row.'%')
				    		->orWhere('training_program_name_id', 'like', '%'.$row.'%');
				    }
	            });


		$must_have = ' '.$request->must_have;
		if (strpos($must_have, "Certification")) {
    		$users = $users->whereIn('users.id', function($query) {

		            	$query->select('users.id')
		            		->from('users')
		            		->join('certifications', function($join){
		            			$join->on('certifications.owner_id', '=', 'users.id')
		            				->on('certifications.owner_role_id', '=', DB::raw("2"));
		            		});

		            });
		}

		if (strpos($must_have, "Evaluation")) {
		}

		if (strpos($must_have, "Video")) {
    		$users = $users->whereIn('users.id', function($query) {

		            	$query->select('users.id')
		            		->from('users')
		            		->join('videos', function($join){
		            			$join->on('videos.owner_id', '=', 'users.id')
		            				->on('videos.owner_role_id', '=', DB::raw("2"));
		            		});
		            		
		            });
		}

		if (strpos($must_have, "Testimonial")) {
    		$users = $users->whereIn('users.id', function($query) {

		            	$query->select('users.id')
		            		->from('users')
		            		->join('testimonials', function($join){
		            			$join->on('testimonials.owner_id', '=', 'users.id')
		            				->on('testimonials.owner_role_id', '=', DB::raw("2"));
		            		});
		            		
		            });
		}



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
	public function trainingNeedsAnalysisWizard()
	{
		$data = array(
			'training-objective'	=> TrainingObjective::get(),
		);
		return view('search.training-needs-analysis')
			->withData($data);
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
		            		->leftJoin('user_skill_nodes', function($join){
		            			$join->on('user_skill_nodes.owner_id', '=', 'providers.id')
		            				->on('user_skill_nodes.owner_role_id', '=', DB::raw("3"));
		            		})
							->leftJoin('skills', 'skills.id', '=', 'user_skill_nodes.skill_id');
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

		
		$must_have = ' '.$request->must_have;
		if (strpos($must_have, "Certification")) {
    		$users = $users->whereIn('users.id', function($query) {

		            	$query->select('users.id')
		            		->from('users')
		            		->join('certifications', function($join){
		            			$join->on('certifications.owner_id', '=', 'users.id')
		            				->on('certifications.owner_role_id', '=', DB::raw("3"));
		            		});

		            });
		}

		if (strpos($must_have, "Evaluation")) {
		}

		if (strpos($must_have, "Video")) {
    		$users = $users->whereIn('users.id', function($query) {

		            	$query->select('users.id')
		            		->from('users')
		            		->join('videos', function($join){
		            			$join->on('videos.owner_id', '=', 'users.id')
		            				->on('videos.owner_role_id', '=', DB::raw("3"));
		            		});
		            		
		            });
		}

		if (strpos($must_have, "Testimonial")) {
    		$users = $users->whereIn('users.id', function($query) {

		            	$query->select('users.id')
		            		->from('users')
		            		->join('testimonials', function($join){
		            			$join->on('testimonials.owner_id', '=', 'users.id')
		            				->on('testimonials.owner_role_id', '=', DB::raw("3"));
		            		});
		            		
		            });
		}


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
				 ->leftJoin('skills', 'user_skill_nodes.skill_id', '=', 'skills.id')
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
				"user_id"						=> $group->id,
				"name"							=> $group->provider_name,
				"email"							=> $group->email,
				"profile_picture"		=> $group->profile_picture,
				"summary"						=> $group->summary,
				"area"							=> "",
				"slug"							=> $group->slug,
				"language"					=> $group_languages_data,
				"material_score"		=> $average_material_score,
				"facility_score"		=> $average_facility_score,
				"delivery_score"		=> $average_delivery_score,
				"score"							=> $average_group_review_score_data,
				"expertises"				=> $group_expertises_data,
				"connection"				=> $total_group_following_data,
				"training"					=> $total_group_speaking_experience_data,
				"review"						=> $total_group_review_data,
			  "view"							=> $group->is_view,
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


	public function getSubObjectives()
	{
		$objectiveId = Input::get('objectiveId');

		$sub = ObjectiveSubObjectiveNode::select('training_sub_objective')
				->join('training_sub_objectives', 'training_sub_objectives.id', '=', 'objective_sub_objective_nodes.sub_objective_id')
				->where('objective_id', '=', $objectiveId)
				->get();

		$value = '<option disabled selected value="0">-- Please Select Objective Detail --</option>';
		foreach ($sub as $row) {
			$value .= '<option value="'.$row->training_sub_objective.'">'.$row->training_sub_objective.'</option>';
		}
		echo $value;
	}

	public function getJobFunctions()
	{
		$subObjective = explode('#', Input::get('subObjective'));

		$jobfunc = SubObjectiveJobFunctionSubCategoryNode::select(DB::raw('distinct job_function_name'))
				->join('job_functions', 'job_functions.id', '=', 'sub_objective_job_function_sub_category_nodes.job_function_id')
				->join('training_sub_objectives', 'training_sub_objectives.id', '=', 'sub_objective_job_function_sub_category_nodes.sub_objective_id')
				->where(function($query) use ($subObjective) {
					foreach ($subObjective as $row) {
						$query->orWhere('training_sub_objective', '=', $row);
					}
				})
				->get();

		/*$value = "";
		foreach ($jobfunc as $row) {
			$value .= $row->job_function_name.',';
		}*/
		$value = '<option disabled selected value="0">-- Please Select Job Function --</option>';
		foreach ($jobfunc as $row) {
			$value .= '<option value="'.$row->job_function_name.'">'.$row->job_function_name.'</option>';
		}
		echo $value;
	}

	public function getSeniorityLevels()
	{
		//$jobFunction = explode('#', Input::get('jobFunction'));

		/*$seniorityLevel = JobNode::select(DB::raw('distinct job_seniority_level_name'))
				->join('job_functions', 'job_functions.id', '=', 'job_nodes.job_function_id')
				->join('job_seniority_levels', 'job_seniority_levels.id', '=', 'job_nodes.job_seniority_level_id')
				->where(function($query) use ($jobFunction) {
					foreach ($jobFunction as $row) {
						$query->orWhere('job_function_name', '=', $row);
					}
				})
				->get();*/
		$seniorityLevel = JobSeniorityLevel::get();

		/*$value = "";
		foreach ($seniorityLevel as $row) {
			$value .= $row->job_seniority_level_name.',';
		}*/
		$value = '<option disabled selected value="0">-- Please Select Seniority Level --</option>';
		foreach ($seniorityLevel as $row) {
			$value .= '<option value="'.$row->job_seniority_level_name.'">'.$row->job_seniority_level_name.'</option>';
		}
		echo $value;
	}

	public function getIndustryTypes()
	{
		//$subObjective = explode('#', Input::get('subObjective'));
		//$jobFunction = explode('#', Input::get('jobFunction'));

		/*$indType = SubObjectiveJobFunctionSubCategoryNode::select(DB::raw('distinct industry_name'))
				->join('job_functions', 'job_functions.id', '=', 'sub_objective_job_function_sub_category_nodes.job_function_id')
				->join('training_sub_objectives', 'training_sub_objectives.id', '=', 'sub_objective_job_function_sub_category_nodes.sub_objective_id')
				->join('industry_sub_category_nodes', 'industry_sub_category_nodes.sub_category_id', '=', 'sub_objective_job_function_sub_category_nodes.sub_category_id')
				->join('industries', 'industries.id', '=', 'industry_sub_category_nodes.industry_id')
				->where(function($query) use ($subObjective) {
					foreach ($subObjective as $row) {
						$query->orWhere('training_sub_objective', '=', $row);
					}
				})
				->where(function($query) use ($jobFunction) {
					foreach ($jobFunction as $row) {
						$query->orWhere('job_function_name', '=', $row);
					}
				})
				->get();*/
		$indType = Industrie::get();

		/*$value = "";
		foreach ($indType as $row) {
			$value .= $row->industry_name.',';
		}*/
		$value = '<option disabled selected value="0">-- Please Select Industry Type --</option>';
		foreach ($indType as $row) {
			$value .= '<option value="'.$row->industry_name.'">'.$row->industry_name.'</option>';
		}
		echo $value;
	}

	public function getRelated()
	{
		$industry = explode('#', Input::get('industry'));

		$skill = IndustrySubCategoryNode::select(DB::raw('distinct skill_name'))
				->join('industries', 'industries.id', '=', 'industry_sub_category_nodes.industry_id')
				->join('sub_category_skill_nodes', 'sub_category_skill_nodes.sub_category_id', '=', 'industry_sub_category_nodes.sub_category_id')
				->join('skills', 'skills.id', '=', 'sub_category_skill_nodes.skill_id')
				->where(function($query) use ($industry) {
					foreach ($industry as $row) {
						$query->orWhere('industry_name', '=', $row);
					}
				})
				->orderBy('skill_name', 'asc')
				->get();

		/*$value = "";
		foreach ($skill as $row) {
			$value .= $row->skill_name.',';
		}*/
		$value = '<option disabled selected value="0">-- Please Select Related Skill --</option>';
		foreach ($skill as $row) {
			$value .= '<option value="'.$row->skill_name.'">'.$row->skill_name.'</option>';
		}
		echo $value;
	}


	public function tnaResult()
	{
		$type = Input::get('type');
		$data = array(
			'type' 					=> Input::get('type'),
			'jobFunction' 			=> explode('#', Input::get('jobfunction')),
			'seniorityLevel' 		=> explode('#', Input::get('senioritylevel')),
			'industryType' 			=> explode('#', Input::get('industry')),
			'skill' 				=> explode('#', Input::get('skill'))
		);

		if($type == "Freelance Trainer")
		{
			$users = User::join('user_role_nodes', 'user_role_nodes.user_id', '=', 'users.id')
					->where('role_id', '=', 2)
		            ->where('users.is_verified', '=', 1)
		            ->where('users.first_name', '!=', '')
		            ->whereIn('users.id', function($query) use ($data) {

		            	$query->select('users.id')
		            		->from('users')
		            		->leftJoin('user_skill_nodes', function($join){
		            			$join->on('user_skill_nodes.owner_id', '=', 'users.id')
		            				->on('user_skill_nodes.owner_role_id', '=', DB::raw("2"));
		            		})
							->leftJoin('skills', 'skills.id', '=', 'user_skill_nodes.skill_id')
							->leftJoin('user_training_program_nodes', function($join){
		            			$join->on('user_training_program_nodes.owner_id', '=', 'users.id')
		            				->on('user_training_program_nodes.owner_role_id', '=', DB::raw("2"));
		            		})
		            		->leftJoin('training_program', 'training_program.id', '=', 'user_training_program_nodes.training_program_id')
		            		->leftJoin('corporates', 'corporates.corporate_name', '=', 'users.corporate_name')
		            		->leftJoin('corporate_industry_nodes', 'corporate_industry_nodes.corporate_id', '=', 'corporates.id')
		            		->leftJoin('industries', 'industries.id', '=', 'corporate_industry_nodes.industry_id')
		            		->where(function($where) use ($data) {
		            			//Search by Job Function
		            			foreach ($data['jobFunction'] as $row) {
							    	if($row != '0')
							    		$where = $where->orWhere('job_function', 'like', '%'.$row.'%');
							    }
		            		})
		            		->where(function($where) use ($data) {
		            			//Search by Seniority Level
								foreach ($data['seniorityLevel'] as $row) {
							    	if($row != '0')
							    		$where = $where->orWhere('job_seniority_level', 'like', '%'.$row.'%');
							    }
		            		})
		            		->where(function($where) use ($data) {
		            			//Search by Industry Type
								foreach ($data['industryType'] as $row) {
									if($row != '0')
							    		$where = $where->orWhere('industry_name', 'like', '%'.$row.'%');
							    }
		            		})
		            		->where(function($where) use ($data) {
								//Search by Skill
								foreach ($data['skill'] as $row) {
									if($row != '0')
							    		$where = $where->orWhere('skill_name', 'like', '%'.$row.'%');
							    }
		            		});
		            
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
		else
		{
			$groups =	Provider::where('providers.profile_picture', '!=', '')
		 				->where('providers.is_verified', '=', 1)
		 				->whereIn('providers.id', function($query) use ($data) {

			            	$query->select('providers.id')
			            		->from('providers')
			            		->leftJoin('user_skill_nodes', function($join){
			            			$join->on('user_skill_nodes.owner_id', '=', 'providers.id')
			            				->on('user_skill_nodes.owner_role_id', '=', DB::raw("3"));
			            		})
								->leftJoin('skills', 'skills.id', '=', 'user_skill_nodes.skill_id')
								->leftJoin('user_training_program_nodes', function($join){
			            			$join->on('user_training_program_nodes.owner_id', '=', 'providers.id')
			            				->on('user_training_program_nodes.owner_role_id', '=', DB::raw("3"));
			            		})
			            		->leftJoin('training_program', 'training_program.id', '=', 'user_training_program_nodes.training_program_id')
			            		/*->where(function($where) use ($data) {
			            			//Search by Job Function
			            			foreach ($data['jobFunction'] as $row) {
								    	$where = $where->orWhere('job_function', 'like', '%'.$row.'%');
								    }
			            		})
			            		->where(function($where) use ($data) {
			            			//Search by Seniority Level
									foreach ($data['seniorityLevel'] as $row) {
								    	$where = $where->orWhere('job_seniority_level', 'like', '%'.$row.'%');
								    }
			            		})
			            		->where(function($where) use ($data) {
			            			//Search by Industry Type
									foreach ($data['industryType'] as $row) {
								    	$where = $where->orWhere('industry_name', 'like', '%'.$row.'%');
								    }
			            		})*/
			            		->where(function($where) use ($data) {
									//Search by Skill
									foreach ($data['skill'] as $row) {
								    	if($row != '0')
								    		$where = $where->orWhere('skill_name', 'like', '%'.$row.'%');
								    }
			            		});

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
					"user_id"						=> $group->id,
					"name"							=> $group->provider_name,
					"email"							=> $group->email,
					"profile_picture"		=> $group->profile_picture,
					"summary"						=> $group->summary,
					"area"							=> "",
					"slug"							=> $group->slug,
					"language"					=> $group_languages_data,
					"material_score"		=> $average_material_score,
					"facility_score"		=> $average_facility_score,
					"delivery_score"		=> $average_delivery_score,
					"score"							=> $average_group_review_score_data,
					"expertises"				=> $group_expertises_data,
					"connection"				=> $total_group_following_data,
					"training"					=> $total_group_speaking_experience_data,
					"review"						=> $total_group_review_data,
				  "view"							=> $group->is_view,
				);
				array_push($groups_data,$group_data);
			endforeach;

			$groups_data_object = json_decode(json_encode($groups_data), FALSE);

			return view('search.grid-list')
				->withGrids($groups_data_object)
				->with('gridType',2);
		}
	}

}
