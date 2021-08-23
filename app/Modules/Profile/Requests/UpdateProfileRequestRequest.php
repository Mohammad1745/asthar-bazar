<?php

namespace App\Modules\Profile\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequestRequest extends FormRequest
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
