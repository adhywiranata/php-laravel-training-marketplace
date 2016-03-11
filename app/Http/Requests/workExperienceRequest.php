<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class workExperienceRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		switch($this->method())
		{
			case 'GET':
			{
				return [
					//
				];
			}

			case 'DELETE':
			{
				return [
					//
				];
			}

			case 'POST':
			{
				return [
					//
					"title"				=>		"required",
					"company"			=>		"required",
					"position"		=>		"required",
					"start_date"	=>		"required",
					"end_date"		=>		"required",
					"description"	=>		"required",
				];
			}

			case 'PUT':
			{
				return [
					//
					"title"				=>		"required",
					"company"			=>		"required",
					"position"		=>		"required",
					"start_date"	=>		"required",
					"end_date"		=>		"required",
					"description"	=>		"required",
				];
			}

			case 'PATCH':
			{
				return [
					//
				];
			}
			default:break;
		}


	}

}
