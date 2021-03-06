<?php

namespace App\Modules\Product\Requests;

use App\Http\Requests\Request;

class StoreProductVariationRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'product_id' => 'required|numeric',
            'type_id' => 'required|numeric',
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|mimes:jpeg,jpg,JPG,png,PNG,gif|max:4000',
            'quantity' => 'required|numeric|min:0',
            'unit_of_quantity' => 'required|string',
            'weight_per_unit' => 'required|numeric|min:0',
            'manufacturing_cost' => 'required|numeric|min:0',
            'regular_price' => 'required|numeric|gte:manufacturing_cost',
            'status' => 'required|numeric',
        ];
    }
}
