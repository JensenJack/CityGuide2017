<?php

namespace Modules\Hotel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHotelRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->segment(3); 
         return [
            'name' => 'required',
            'address' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'phone' => 'required',
            'logo' => 'image',
            'email' => 'required|email|unique:hotel,email,'.$id,
            'description' => 'required',
            'class' => 'required|numeric',
          
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Hotel name is required!',
            'address.required' => 'Hotel address is required!',
            'latitude.required' => 'Hotel latitude is required!',
            'longitude.required' => 'Hotel longitude is required!',
            'logo.required' => 'Hotel logo is required!',
            'phone.required' => 'Hotel phone number is required!',
            'email.required' => 'Hotel email is required!',
            'description.required' => 'Hotel description is required!',
            'class.required' => 'Hotel class is required!',
            ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-hotel');
    }
}
