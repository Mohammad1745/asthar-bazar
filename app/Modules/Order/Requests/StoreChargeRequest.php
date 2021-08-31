<?php

namespace App\Modules\Order\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class StoreChargeRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() :array
    {
        return [
            'order_id' => 'required|numeric',
            'title' => 'required|array',
            'amount' => 'required|array',
            'title.*' => 'required|string',
            'amount.*' => 'required|min:0|numeric',
        ];
    }
}
