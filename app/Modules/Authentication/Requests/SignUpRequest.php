<?php

namespace App\Modules\Authentication\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
            'username' => 'required|string|unique:App\User,username',
            'email' => 'required|email|unique:App\User,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
            'referral_code' => isset($this->referral_code) ? 'string' : '',
        ];
    }
}
