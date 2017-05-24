<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
{
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
            'name'=>'required|min:3|max:50',
			'seudonimo'=>'required|min:8|max:50|unique:users',
			'surname'=>'required|min:3|max:50',
			'email'=>'email|required|unique:users',
			'password'=>'required|min:8|max:255',
			'type'=>'required',
			'sex'=>'required',
			'dateofbith'=>'required',
        ];
    }
}
