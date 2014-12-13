<?php namespace TGLD\Http\Requests;

use Illuminate\Contracts\Auth\Guard;

class StartTaskRequest extends Request
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
            'task_id' => 'required'
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
