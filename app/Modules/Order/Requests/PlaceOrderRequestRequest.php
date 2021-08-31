<?php

namespace App\Modules\Order\Requests;

use App\Http\Requests\Request;

class PlaceOrderRequestRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() :array
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
