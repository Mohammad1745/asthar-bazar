<?php

namespace App\Modules\News\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
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
            'id' => 'required|numeric',
            'content' => 'required|string',
            'image' => isset($this->image) ? 'mimes:jpeg,jpg,JPG,png,PNG,gif|max:4000' : '',
        ];
    }
}
