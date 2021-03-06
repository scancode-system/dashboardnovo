<?php

namespace Modules\Dashboard\Http\Requests\Order;

use Illuminate\Validation\Rule;
use Modules\Dashboard\Entities\Item;
use Modules\Dashboard\Rules\Multiple;
use Modules\Dashboard\Entities\Product;
use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $order_id = $this->order_id;
        $product = Product::find($this->product_id);
        if(!$product && isset($this->id)){
            $item = Item::find($this->id);
            $product = Product::find($item->product_id);
        }

        $product_id = 1;
        $min_qty = 1;
        $multiple = 1;

        if($product){
            $product_id = $product->id;
            $min_qty = $product->min_qty;
            $multiple = $product->multiple;
        }

        if(request()->method() == 'POST'){
            return [
                'product_id' => ['required', 'integer', 'min:1', Rule::unique('items')->where(function ($query) use($order_id, $product_id) {
                    return $query->where('order_id', $order_id)
                    ->where('product_id', $product_id);
                })],
                'qty' => ['required', 'integer', 'min:'.$min_qty, new Multiple($multiple)],
                'discount' => 'numeric|min:0|max:100|regex:/^\d+(\.\d{1,2})?$/'
            ];
        } else if(request()->method() == 'PUT'){
            return [
                'qty' => ['required', 'integer', 'min:'.$min_qty, new Multiple($multiple)],
                'discount' => 'numeric|min:0|max:100|regex:/^\d+(\.\d{1,2})?$/'
            ];
        }
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

    public function messages()
    {
        return [
            'qty.min' => 'A quantidade precisa ser no mínimo :min',
            'product_id.unique' => 'Este produto já está no pedido.',
            'discount.numeric' => 'Disconto precisa ser numérico',
            'discount.max' => 'Disconto não pode ser maior que :max',
            'discount.min' => 'Disconto não pode ser menor que :min',
        ];
    }
}
