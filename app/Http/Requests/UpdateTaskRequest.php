<?php namespace TGLD\Http\Requests;


class UpdateTaskRequest extends Request {

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
            'priority' => 'required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::check())
        {
            return true;
        }

        return false;
    }

}
