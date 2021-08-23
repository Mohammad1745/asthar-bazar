<?php

namespace App\Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'zip_code' => 'required|string',
            'city' => 'required|string',
            'phone_code' => 'required|string',
            'phone' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|same:password',
        ];
    }
}
