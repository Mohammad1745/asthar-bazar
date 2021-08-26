<?php

namespace App\Modules\Contact\Requests;

use App\Http\Requests\Request;

class StoreContactMessageRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'to' => 'required|string',
            'message' => 'required|string',
        ];
    }
}
