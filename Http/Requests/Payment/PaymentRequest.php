<?php

namespace Modules\Dashboard\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'description' => 'required|unique:payments,description'.(isset($this->id)?','.$this->id.',id':''),
            'min_value' => 'numeric|min:0|max:10000000|regex:/^\d+(\.\d{1,2})?$/',
            'discount' => 'numeric|min:0|max:100|regex:/^\d+(\.\d{1,2})?$/',
            'addition' => 'numeric|min:0|max:100|regex:/^\d+(\.\d{1,2})?$/'
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
