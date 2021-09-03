<?php

namespace App\Modules\Profile\Requests;

use App\Http\Requests\Request;

class UpdateProfileRequestRequest extends Request
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
            'email' => 'required|email',
            'country' => isset($this->country) ? 'required|string' : '',
            'address' => isset($this->address) ? 'required|string' : '',
            'zip_code' => isset($this->zip_code) ? 'required|numeric' : '',
            'city' => isset($this->city) ? 'required|string' : '',
            'phone_code' => isset($this->phone_code) ? 'required|string' : '',
            'phone' => isset($this->phone) ? 'required|string' : '',
        ];
    }
}
