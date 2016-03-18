<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use DB;
use Auth;
use App\Models\User as User;
use App\Models\Contact as Contact;

use Illuminate\Support\Facades\Session;

class ContactController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users =	DB::table('contacts')
						 ->join('users', 'contacts.contact_owner_id', '=', 'users.id')
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
				$total_user_review_data = 0;
				$average_user_review_score_data = "-";
				// REVIEW -->

				//CONTACT
				$user_contact =	DB::table('contacts')
												 ->where('contacts.contact_owner_id', '=', $user->id)
												 ->where('contacts.contact_owner_role_id', '=', 2)
												 ->get();

				$total_user_connection_data = count($user_contact);
				// CONTACT -->

				//ALL TRAINER DATA
				$user_data = array(
					"user_id"								=> $user->id,
					"name"									=> $user->first_name . ' ' . $user->last_name,
					"email"									=> $user->email,
					"phone_number"					=> $user->phone_number,
					"profile_picture"				=> $user->profile_picture,
					"summary"								=> $user->summary,
					"area"									=> $user->service_area,
					"slug"									=> $user->slug,
					"language"							=> $user_languages_data,
					"score"									=> $average_user_review_score_data,
					"expertises"						=> $user_expertises_data,
					"connection"						=> $total_user_connection_data,
					"review"								=> $total_user_review_data,
					"view"									=> $user->is_view,
				);
				array_push($users_data,$user_data);
		endforeach;

		$users_data_object = json_decode(json_encode($users_data), FALSE);

		return view('profile.contacts')
			->withGrids($users_data_object)
			->with('gridType',1);
	}

	public function createContact($contact_owner_id,$contact_owner_role_id)
	{
		$session_owner_id = Session::get('owner_id');
		$session_owner_role_id = Session::get('owner_role_id');

		$insert = [
			'owner_id' => $session_owner_id,
			'owner_role_id' => $session_owner_role_id,
			'contact_owner_id' => $contact_owner_id,
			'contact_owner_role_id' => $contact_owner_role_id
		];

		$contact = Contact::create($insert);
	}

	public function deleteContact($contact_owner_id,$contact_owner_role_id)
	{
		$session_owner_id = Session::get('owner_id');
		$session_owner_role_id = Session::get('owner_role_id');

		$delete = [
			'owner_id' => $session_owner_id,
			'owner_role_id' => $session_owner_role_id,
			'contact_owner_id' => $contact_owner_id,
			'contact_owner_role_id' => $contact_owner_role_id
		];

		$contact = Contact::where($delete)->delete();
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
