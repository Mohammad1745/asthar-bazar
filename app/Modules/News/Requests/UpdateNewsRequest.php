<?php

namespace App\Modules\News\Requests;

use App\Http\Requests\Request;

class UpdateNewsRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'id' => 'required|numeric',
            'content' => 'required|string',
            'image' => isset($this->image) ? 'mimes:jpeg,jpg,JPG,png,PNG,gif|max:4000' : '',
        ];
    }
}
