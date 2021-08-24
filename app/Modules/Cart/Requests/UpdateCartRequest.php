<?php

namespace App\Modules\Cart\Requests;

use App\Http\Requests\Request;

class UpdateCartRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'id' => 'required|array',
            'id.*' => 'required|numeric',
            'product_variation_id' => 'required|array',
            'product_variation_id.*' => 'required|numeric',
            'quantity' => 'required|array',
            'quantity.*' => 'required|numeric|min:0'
        ];
    }
}
