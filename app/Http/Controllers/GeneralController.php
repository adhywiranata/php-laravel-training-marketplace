<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

use App\Models\Corporate as Corporate;

//Training Experience
use App\Models\TrainingExperience as TrainingExperience;
use App\Models\TrainingExperienceProgramNode as TrainingExperienceProgramNode;

use App\Models\WorkExperience as WorkExperience;

//Skills
use App\Models\Skill as Skill;
use App\Models\UserSkillNode as UserSkillNode;
use App\Models\SectionSkill as SectionSkill;

//Photo
use App\Models\SectionPhotoNode as SectionPhotoNode;

//Training Program
use App\Models\TrainingProgram as TrainingProgram;
use App\Models\UserTrainingProgramNode as UserTrainingProgramNode;

use App\Http\Requests\trainingExperienceRequest;
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
		$session_owner_id = 1;
		$session_owner_role_id = 2;

		//CHECK IF CORPORATE DOES NOT EXIST,CREATE A NEW ONE
		$corporate = Corporate::where('corporate_name',$input['company'])->first();
		if(count($corporate) == 0)
		{
			$corporate = Corporate::create([ 'corporate_name' => $input['company'] ]);
		}

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

		return redirect('dashboard');
	}

	public function editTrainingExperience($id)
	{
		$training_experience	=		DB::table('training_experiences')
												  ->select('*','training_experiences.id AS training_experience_id')
												  ->join('corporates','training_experiences.corporate_id','=','corporates.id')
												  ->where('training_experiences.id', '=', $id)
												  ->first();

		return view('profile.forms.add-training-experience')
								->with('training_experience',$training_experience);
	}

	public function updateTrainingExperience($id , workExperienceRequest $request)
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

	public function deleteTrainingExperience($id)
	{
		WorkExperience::find($id)->delete();

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
