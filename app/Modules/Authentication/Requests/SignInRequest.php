<?php

namespace App\Modules\Authentication\Requests;

use App\Http\Requests\Request;

class SignInRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ():array
    {
        return [
            'email_username' => 'required|string',
            'password' => 'required',
        ];
    }
}
