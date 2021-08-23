<?php

namespace App\Modules\Authentication\Requests;

use App\Http\Requests\Request;

class VerifyEmailRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ():array
    {
        return [
            'verification_code' => 'required',
        ];
    }
}
