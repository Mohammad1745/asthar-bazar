<?php

namespace App\Modules\Authentication\Requests;

use App\Http\Requests\Request;

class SignUpRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ():array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required|string|unique:App\User,username',
            'email' => 'required|email|unique:App\User,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
            'referral_code' => isset($this->referral_code) ? 'string' : '',
        ];
    }
}
