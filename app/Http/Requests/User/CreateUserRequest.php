<?php namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest {

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
		return [
			'name' => 'required',
			//'nickname' => 'required',
			//'gender' => 'required',
			//'group_id' => 'required',
			//'phone_number' => 'required',
			//'address' => 'required',
			//'birthdate' => 'required|date_format:"Y-m-d"',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'confirmed|min:5',
			'roles_user' => 'required'
		];
	}

}
