<?php

namespace App\Modules\Authentication\Requests;

use App\Http\Requests\Request;

class ResetPasswordRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ():array
    {
        return [
            'reset_password_code' => 'required',
            'new_password' => 'required|min:8',
            'password_confirmation' => 'required|same:new_password'
        ];
    }
}
