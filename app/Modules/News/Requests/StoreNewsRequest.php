<?php

namespace App\Modules\News\Requests;


use App\Http\Requests\Request;

class StoreNewsRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'content' => 'required|string',
            'image' => 'required|mimes:jpeg,jpg,JPG,png,PNG,gif|max:4000',
        ];
    }
}
