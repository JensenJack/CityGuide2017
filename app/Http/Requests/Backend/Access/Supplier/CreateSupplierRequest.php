<?php

namespace App\Http\Requests\Backend\Access\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class CreateSupplierRequest extends FormRequest
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

            'name'     => 'required|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
           
        ];
    }

    public function messages()
    {
        return [
            
            'name.required'     => 'Name is required.',
            'email.required'    => 'Email is required',
            'password.required' => 'Password must be filled.',
        ];
    }
}
