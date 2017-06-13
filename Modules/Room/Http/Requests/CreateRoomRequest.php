<?php

namespace Modules\Room\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoomRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status'                        => 'required',
            'name'                          => 'required',
            'meta_keyword'                  => 'required',
            'meta_description'              => 'required',
            'hotel_id'                      => 'required',
            'room_category_id'              => 'required',
            'description'                   => 'required',
            'quantity'                      => 'required|numeric',
            'minimum_stay'                  => 'required|numeric',
            'max_adults'                    => 'required|numeric',
            'extra_bed'                     => 'required|numeric',
            'extra_bed'                     => 'required|numeric',
            'extra_bed_charge'              => 'required|numeric',
            'local_buy_price'               => 'required|numeric',
            'local_sell_price'              => 'required|numeric|min:'.$this->local_buy_price,
            'foreign_buy_price'             => 'required|numeric',
            'foreign_sell_price'            => 'required|numeric|min:'.$this->foreign_buy_price,
            'agent_buy_price'               => 'required|numeric',
            'agent_sell_price'              => 'required|numeric|min:'.$this->agent_sell_price,
        ];
    }

    public function messages()
    {
        return[
            'hotel_id.required' => 'The hotel name is required',
            'room_category_id.required' => 'The room type is required',
        ];
        
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-room');
    }
}
