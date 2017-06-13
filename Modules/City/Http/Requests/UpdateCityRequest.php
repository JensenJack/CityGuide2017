<?php

namespace Modules\City\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCityRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'longitude'=>'required|numeric',
            'latitude'=>'required|numeric',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-city');
    }
    
    public function messages()
    {
        return [
            'name.required'=>'City name is required',
            'longitude.required'=>'Longitude is required',
            'latitude.required'=>'Latitude is required',
        ];

    }
}
