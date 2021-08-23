<?php

namespace App\Modules\Collection\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreCollectionItemRequest extends FormRequest
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
            'collection_id' => 'required|numeric',
            'product_variation_id' => 'required|numeric',
            'discount' => 'required|numeric|min:0',
            'expires_at' => 'required|date|after:'.Carbon::now(),
        ];
    }
}
