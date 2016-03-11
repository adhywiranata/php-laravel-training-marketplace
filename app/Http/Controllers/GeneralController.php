<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

use App\Models\Corporate as Corporate;
use App\Models\WorkExperience as WorkExperience;

use App\Models\Skill as Skill;
use App\Models\UserSkillNode as UserSkillNode;

use App\Http\Requests\workExperienceRequest;
use App\Http\Requests\skillRequest;

class GeneralController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('landing');
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
		$session_owner_id = 1;
		$session_owner_role_id = 2;

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

		echo "<script type='text/javascript'>alert('Insert Success');</script>";exit();
		//return view('profile.forms.add-work-experience');//DIGANTI KE PROFILE
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

		echo "<script type='text/javascript'>alert('Update Success');</script>";exit();
	}

	public function deleteWorkExperience($id)
	{
		WorkExperience::find($id)->delete();
		echo "<script type='text/javascript'>alert('Delete Success');</script>";exit();
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

	/**
	* Display user training experience form page
	*
	* @return Response
	*/
	public function addAward()
	{
		return view('profile.forms.add-award');
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
		$session_owner_id = 1;
		$session_owner_role_id = 2;

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

}
