<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
// CRUD Template
use App\Models\General;

// Image Resize & Crop (Have to Install first Invertention Image)
use Intervention\Image\Facades\Image;

class TrainingController extends Controller {

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
	public function getTrainings()
	{
		$select =
		[
			"table"			=> "temp_training",
		];

		$trainings = General::Selects($select)->get();
		return view('training.manage-training.company.training-list')->with('trainings',$trainings);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getTrainingDetail()
	{
		$select =
		[
			"table"			=> "temp_evaluation",
		];

		$evaluations = General::Selects($select)->get();
		return view('training.manage-training.company.training-detail')->with('evaluations',$evaluations);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function createTraining()
	{
		//send ->withForm(1) on view return to generate forms
		return view('training.manage-training.company.form')->withForm(1);
	}

	public function insertTraining(Request $request)
	{
		$input = $request;

		$create =
		[
			"table"			=> "temp_training",
			"data"			=>
									[
										"title"										=> $input->input('title'),
										"training_provider"				=> $input->input('training_provider'),
										"trainer"									=> $input->input('trainer'),
										"start_date"							=> $input->input('start_date_year').'-'.$input->input('start_date_month').'-'.$input->input('start_date_day'),
										"end_date"								=> $input->input('end_date_year').'-'.$input->input('end_date_month').'-'.$input->input('end_date_day'),
										"training_area"						=> $input->input('topic'),
										"method"									=> $input->input('method'),
										"venue"										=> $input->input('venue'),
										"pic_name"								=> $input->input('pic_name'),
										"material"								=> $input->input('material'),
										"delivery"								=> $input->input('delivery'),
										"facility"								=> $input->input('facility'),
										"total_participants"			=> $input->input('participant'),
										"participants_department"	=> $input->input('department'),
										"language"								=> $input->input('language'),
										"average_post_test_score"	=> $input->input('avg_post_test_score'),
										"team_lead"								=> $input->input('team_lead'),
										"competencies"						=> $input->input('competencies'),
									]
		];
		$users = General::Creates($create);

		return redirect('asd/trainings');
		//End here
	}

	public function insertEvaluation(Request $request)
	{
		$input = $request;

		$create =
		[
			"table"			=> "temp_evaluation",
			"data"			=>
									[
										"audience_name"					=> $input->input('audience_name'),
										"job_title"							=> $input->input('job_title'),
										"job_level"							=> $input->input('job_level'),
										"job_function"					=> $input->input('job_function'),
										"material"							=> $input->input('material'),
										"material_description"	=> $input->input('material_description'),
										"delivery"							=> $input->input('delivery'),
										"delivery_description"	=> $input->input('delivery_description'),
										"facility"							=> $input->input('facility'),
										"facility_description"	=> $input->input('facility_description'),
										"Post Test Score"				=> $input->input('post_test_score'),
									]
		];
		$users = General::Creates($create);

		return redirect('asd/training/asd');
		//End here
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function createEvaluation()
	{
		return view('training.manage-training.company.evaluation-form')->withForm(1);
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
