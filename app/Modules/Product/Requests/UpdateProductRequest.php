<?php

namespace App\Modules\Product\Requests;

use App\Http\Requests\Request;

class UpdateProductRequest extends Request
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
            'title' => 'required|string',
            'category_id' => 'required|numeric',
        ];
    }
}
