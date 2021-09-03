<?php

namespace App\Modules\Type\Requests;

use App\Http\Requests\Request;

class StoreTypeRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
        ];
    }
}
