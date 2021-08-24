<?php

namespace App\Modules\Category\Requests;

use App\Http\Requests\Request;

class UpdateCategoryRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ():array
    {
        return [
            'id' => 'required|numeric',
            'title' => 'required|string',
            'parent_id' => isset($this->parent_id) ? 'numeric' : '',
            'description' => 'required|string',
        ];
    }
}
