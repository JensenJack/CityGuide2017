<?php

namespace Modules\Room\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                          => 'required',
            'meta_keyword'                  => 'required',
            'meta_description'              => 'required',
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
            'agent_sell_price'              => 'required|numeric|min:'.$this->agent_buy_price,
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-room');
    }
}
