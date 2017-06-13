<?php

namespace Modules\Gallery\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGalleryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
                    'category_id' => 'required',
                    'name'        => 'required',
                    'type'        => 'required'
                ];

        if($this->input('type') == 'image'){
            $rules['image'] = 'required|image';
        }
        else{
            $rules['url'] = 'required|url';
        }

        return $rules;
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
