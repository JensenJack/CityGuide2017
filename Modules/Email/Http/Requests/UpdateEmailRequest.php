<?php

namespace Modules\Email\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmailRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             'subject' => 'required',
              'ledgen' => 'required',
              'content' => 'required',
              'mm_subject' => 'required',
              'mm_content' => 'required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-email');
    }
}
