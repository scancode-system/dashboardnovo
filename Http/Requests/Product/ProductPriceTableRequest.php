<?php

namespace Modules\Dashboard\Http\Requests\Product;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;


class ProductPriceTableRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $product_id = $this->product_id;
        $price_table_id = $this->price_table_id;
        return [
            'price' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'price_table_id' => [Rule::unique('product_price_tables')->where(function ($query) use($product_id, $price_table_id) {
                return $query->where('product_id', $product_id)
                ->where('price_table_id', $price_table_id);
            })],
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
