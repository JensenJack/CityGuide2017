<?php

namespace Modules\Sms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSmsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ledgen'        => 'required',
            'content'       => 'required',
            'mm_content'    => 'required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-sms');
    }
}
