<?php

namespace App\Modules\FAQ\Requests;

use App\Http\Requests\Request;

class UpdateFAQRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'about_us' => isset($this->about_us) ? 'string' : '',
            'about_us_bn' => isset($this->about_us_bn) ? 'string' : '',
            'offerings' => isset($this->offerings) ? 'string' : '',
            'offerings_bn' => isset($this->offerings_bn) ? 'string' : '',
            'payment_information' => isset($this->payment_information) ? 'string' : '',
            'payment_information_bn' => isset($this->payment_information_bn) ? 'string' : '',
            'delivery_information' => isset($this->delivery_information) ? 'string' : '',
            'delivery_information_bn' => isset($this->delivery_information_bn) ? 'string' : '',
            'order_guideline' => isset($this->order_guideline) ? 'string' : '',
            'order_guideline_bn' => isset($this->order_guideline_bn) ? 'string' : '',
            'terms_and_conditions' => isset($this->terms_and_conditions) ? 'string' : '',
            'terms_and_conditions_bn' => isset($this->terms_and_conditions_bn) ? 'string' : '',
            'privacy_policy' => isset($this->privacy_policy) ? 'string' : '',
            'privacy_policy_bn' => isset($this->privacy_policy_bn) ? 'string' : '',
            'image' => isset($this->image) ? 'mimes:jpeg,jpg,JPG,png,PNG,gif|max:4000' : '',
        ];
    }
}
