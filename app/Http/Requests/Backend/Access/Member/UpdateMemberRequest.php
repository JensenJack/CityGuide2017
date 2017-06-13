<?php

namespace App\Http\Requests\Backend\Access\Member;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberRequest extends FormRequest
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
        $id=$this->segment(4);
        return [

            'name'     => 'required|max:255',
            'email'    => 'required|email|unique:users,email,'.$id,
        
           
        ];
    }

    public function messages()
    {
        return [
            
            'name.required'     => 'Name is required.',
            'email.required'    => 'Email is required',
        
        ];
    }
}
