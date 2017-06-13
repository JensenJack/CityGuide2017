<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\Request;

/**
 * Class BookingConfirmRequest
 * @package App\Http\Requests\Frontend
 */
class BookingConfirmRequest extends Request
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
             'payment_method'  => 'required'
        ];
    }
}