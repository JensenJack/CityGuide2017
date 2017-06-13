<?php

namespace Modules\Hotel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHotelRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   

        return [
            'name' => 'required',
            'address' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'logo' => 'required|image',
            'phone' => 'required',
            'email' => 'required|email|unique:hotel,email',
            'description' => 'required',
            'class' => 'required',
            'city_id' => 'required',
            'hotel_category_id' => 'required',
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
            'city_id.required' => 'City is required!',
            'hotel_category_id.required' => 'Hotel type is required!',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-hotel');
    }
}
