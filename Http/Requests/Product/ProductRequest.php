<?php

namespace Modules\Dashboard\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Product\Events\ProductRequestRulesEvent;


class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sku' => 'required|string|max:255',
            'barcode' => 'required|string|max:255|unique:products,barcode'.(isset($this->id)?','.$this->id.',id':''),
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'min_qty' => 'integer|min:1',
            'discount_limit' => 'numeric|between:0,100|regex:/^\d+(\.\d{1,2})?$/',
            'multiple' => 'integer|min:1',
            'product_category_id' => 'integer|min:1',
            'ipi' =>  'numeric|between:0,100|regex:/^\d+(\.\d{1,2})?$/',
            'color_id' => 'nullable|integer|min:1',
            'size_id' => 'nullable|integer|min:1'
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
