<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

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
