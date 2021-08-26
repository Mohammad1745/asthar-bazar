<?php

namespace App\Modules\Contact\Requests;

use App\Http\Requests\Request;

class ReplyContactMessageRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'message_id' => 'required|numeric',
            'message' => 'required|string',
        ];
    }
}
