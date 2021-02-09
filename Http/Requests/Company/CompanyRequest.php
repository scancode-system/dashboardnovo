<?php

namespace Modules\Dashboard\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cnpj' => 'max:14',
            'state_registration' => 'max:12',
            'email' => 'nullable|email',
            'st' => 'max:2',
            'postcode' => 'max:8'
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


    protected function prepareForValidation()
    {
        $all = $this->all();
        if(isset($all['cnpj'])){
            $all['cnpj'] = preg_replace('/\D/', '', $all['cnpj']);
        } 
        if(isset($all['state_registration'])){
            $all['state_registration'] = preg_replace('/\D/', '', $all['state_registration']);
        }
        if(isset($all['postcode'])){
            $all['postcode'] = preg_replace('/\D/', '', $all['postcode']);
        }

        $this->replace($all);
    }
}
