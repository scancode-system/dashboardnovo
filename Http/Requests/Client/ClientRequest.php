<?php

namespace Modules\Dashboard\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Dashboard\Entities\SettingClient;


class ClientRequest extends FormRequest
{


    private $setting_client;

    public function __construct() {
        $this->setting_client = SettingClient::get();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'corporate_name' => $this->setting_client->corporate_name_required.'|string|max:255|unique:clients,corporate_name'.(isset($this->id)?','.$this->id.',id':''),
            'fantasy_name' => 'nullable|string|max:255',
            'cpf_cnpj' => $this->setting_client->cpf_cnpj_required.'|string|unique:clients,cpf_cnpj'.((isset($this->id)?','.$this->id.',id':'')).'|'.$this->setting_client->validation_cpf_cnpj_active,                // tem que fazer um custom para este
            'buyer' => $this->setting_client->buyer_required.'|string|max:255',
            'email' => $this->setting_client->email_required.'|string|email|max:255',
            'phone' => $this->setting_client->phone_required.'|string|max:255',
            'street' => 'nullable|string|max:255',
            'number' => 'nullable|integer|min:0',
            'apartment' => 'nullable|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'st' => 'nullable|string|max:2',
            'postcode' => 'nullable|string|max:8',
        ];
    }

    protected function getValidatorInstance() {
        $all = $this->all();
        if(isset($all['cpf_cnpj'])){
            if ($all['cpf_cnpj'] == '') {
                $all['cpf_cnpj'] = null;
            } else {
                $all['cpf_cnpj'] = preg_replace('/[^0-9]/', '', (string) $all['cpf_cnpj']);
            }
        }
        $this->replace($all);
        return parent::getValidatorInstance();
    }

    public function messages() {
        return [
            'cpf_cnpj.cpf_cnpj' => 'O CPF ou CNPJ não são válidos',
            'corporate_name.required' => 'Razão social é obrigatório',
            'cpf_cnpj.required' => 'CPF e CNPJ é obrigatório',
            'buyer.required' => 'Nome do Comprador é obrigatório',
            'email.required' => 'Email é obrigatório',
            'phone.required' => 'Telefone é obrigatório',
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
