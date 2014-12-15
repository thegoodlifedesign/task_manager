<?php namespace TGLD\Http\Requests\Tasks;

use Illuminate\Contracts\Auth\Guard;
use TGLD\Http\Requests\Request;

class AddTaskRequest extends Request
{
	protected $auth;

	function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'title' => 'required',
            'description' => 'required',
            'project' => 'required',
            'assigned_to' => 'required',
            'assigned_from' => 'required',
			'website_link' => 'sometimes|url',
			'related_link' => 'sometimes|url',
			'due_date' => 'required|date',
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		if($this->auth->check())
        {
            return true;
        }

        return false;
	}

}
