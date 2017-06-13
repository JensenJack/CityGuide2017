<?php

namespace Modules\HotelSupplier\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHotelSupplierRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'hotel_id_list'=>'required',
        ];
    }

     public function messages()
    {
        return [
            'hotel_id_list.required'=>'Choose at least one hotel.',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
