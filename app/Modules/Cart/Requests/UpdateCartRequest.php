<?php

namespace App\Modules\Cart\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCartRequest extends FormRequest
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
            'id' => 'required|array',
            'id.*' => 'required|numeric',
            'product_variation_id' => 'required|array',
            'product_variation_id.*' => 'required|numeric',
            'quantity' => 'required|array',
            'quantity.*' => 'required|numeric|min:0'
        ];
    }
}
