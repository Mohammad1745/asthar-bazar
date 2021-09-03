<?php

namespace App\Modules\User\Requests;

use App\Http\Requests\Request;

class UpdateUserRequest extends Request
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'country' => 'required|string',
            'address' => 'required|string',
            'zip_code' => 'required|string',
            'city' => 'required|string',
            'phone_code' => 'required|string',
            'phone' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string',
            'password' => isset($this->password) ? 'required|string|min:8' : '',
            'password_confirmation' => isset($this->password) ? 'required|string|same:password' : '',
        ];
    }
}
