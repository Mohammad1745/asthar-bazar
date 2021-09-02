<?php

namespace App\Modules\Product\Requests;

use App\Http\Requests\Request;

class StoreProductRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'title' => 'required|string',
            'category_id' => 'required|numeric'
        ];
    }
}
