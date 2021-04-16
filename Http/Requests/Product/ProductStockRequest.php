<?php

namespace Modules\Dashboard\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Product\Events\ProductRequestRulesEvent;


class ProductStockRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'qty_now' => 'integer|min:0',
            'qty_future' => 'integer|min:0'
        ];
    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
