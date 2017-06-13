<?php

namespace Modules\Booking\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       $tomorrow = date("Y-m-d H:I", time() + 86400);
       $today=date("Y-m-d H:I",time());
        return [
            
            'guest_name' => 'required',
            'check_in_name' => 'required',
            'guest_email' => 'required',
            'guest_phone' => 'required',
            'hotelcategory_id' => 'required',
            'hotel_id' => 'required',
            'room_id' => 'required',
            'quantity' => 'required',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'booking_expire' => 'required|date|before:check_in_date',
            'discount' => 'required',
            
        
        ];
    }

     public function messages()
    {

        return [
            
            'guest_name.required'                => 'Your Name is required.',
            'check_in_name.required'             => 'Check In Name is required.',
            'guest_email.required'               => 'Your Email is required.',
            'guest_phone.required'               => 'Your Pone Number is required.',
            'hotelcategory_id.required'          => 'Choose your hotel type.',
            'hotel_id.required'                  => 'Choose your hotel name.',
            'room_id.required'                   => 'Choose your room.',
            'quantity.required'                  => 'Quantity cannot be blank.',
            'check_in_date.required'             => 'Choose your check in date',
            'check_out_date.required'            => 'Choose your check out date',
            'booking_expire.required'            => 'Choose your booking expire date',
            'discount.required'                  => 'Discount rate cannot be blank.',

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
