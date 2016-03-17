<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class trainingExperienceRequest extends Request {

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
					"training_experience"		=>		"required",
					"training_program"			=>		"required",
				];
			}

			case 'PUT':
			{
				return [
					//
					"training_experience"		=>		"required",
					"training_program"			=>		"required",
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
