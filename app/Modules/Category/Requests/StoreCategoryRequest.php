<?php

namespace App\Modules\Category\Requests;


use App\Http\Requests\Request;

class StoreCategoryRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ():array
    {
        return [
            'title' => 'required|string',
            'parent_id' => isset($this->parent_id) ? 'numeric' : '',
            'description' => 'required|string',
        ];
    }
}
