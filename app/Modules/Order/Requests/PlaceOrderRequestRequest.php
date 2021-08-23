<?php

namespace App\Modules\Order\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceOrderRequestRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'country' => 'required|string',
            'address' => 'required|string',
            'zip_code' => 'required|numeric',
            'city' => 'required|string',
            'phone_code' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'tc_checkbox' => 'required',
            'coupon' => 'required|numeric',
        ];
    }
}
