<?php

namespace App\Modules\FAQ\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFAQRequest extends FormRequest
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
            'about_us' => isset($this->about_us) ? 'required|string' : '',
            'about_us_bn' => isset($this->about_us_bn) ? 'required|string' : '',
            'offerings' => isset($this->offerings) ? 'required|string' : '',
            'offerings_bn' => isset($this->offerings_bn) ? 'required|string' : '',
            'payment_information' => isset($this->payment_information) ? 'required|string' : '',
            'payment_information_bn' => isset($this->payment_information_bn) ? 'required|string' : '',
            'delivery_information' => isset($this->delivery_information) ? 'required|string' : '',
            'delivery_information_bn' => isset($this->delivery_information_bn) ? 'required|string' : '',
            'order_guideline' => isset($this->order_guideline) ? 'required|string' : '',
            'order_guideline_bn' => isset($this->order_guideline_bn) ? 'required|string' : '',
            'terms_and_conditions' => isset($this->terms_and_conditions) ? 'required|string' : '',
            'terms_and_conditions_bn' => isset($this->terms_and_conditions_bn) ? 'required|string' : '',
            'privacy_policy' => isset($this->privacy_policy) ? 'required|string' : '',
            'privacy_policy_bn' => isset($this->privacy_policy_bn) ? 'required|string' : '',
            'image' => isset($this->image) ? 'mimes:jpeg,jpg,JPG,png,PNG,gif|max:4000' : '',
        ];
    }
}
