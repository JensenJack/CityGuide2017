<?php

namespace Modules\HotelSupplier\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHotelSupplierRequest extends FormRequest
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
            'supplier_id'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'hotel_id_list.required'=>'Please Select Hotel.',
            'supplier_id.required'=>'Please Select Supplier.',
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
