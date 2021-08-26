<?php

namespace App\Modules\Collection\Requests;

use App\Http\Requests\Request;
use Carbon\Carbon;

class UpdateCollectionRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'id' => 'required|numeric',
            'title' => 'required|string',
            'discount' => 'required|numeric|min:0',
            'expires_at' => 'required|date|after:'.Carbon::now(),
        ];
    }
}
