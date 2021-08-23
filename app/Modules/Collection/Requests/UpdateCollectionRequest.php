<?php

namespace App\Modules\Collection\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCollectionRequest extends FormRequest
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
            'id' => 'required|numeric',
            'title' => 'required|string',
            'discount' => 'required|numeric|min:0',
            'expires_at' => 'required|date|after:'.Carbon::now(),
        ];
    }
}
