<?php

namespace App\Modules\Department\Requests;

use App\Http\Requests\Request;

class StoreDepartmentRequest extends Request
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
            'owner_id' => 'required|numeric',
            'description' => 'required|string',
        ];
    }
}
