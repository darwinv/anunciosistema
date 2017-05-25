<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class publicationRequest extends Request
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
            'title'        =>  'required|min:5|max:50',
			'price'        =>  'required|min:1',
			'garantia'     =>  'required',
			'condition_id' =>  'required',
			'imagenes'     =>  'required',
			'category_id' =>   'required'
        ];
    }
}
