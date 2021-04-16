<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SettingClient extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'client_start', 'corporate_name', 'cpf_cnpj', 'buyer', 'email', 'phone', 'validation_cpf_cnpj'];

    protected $table = 'setting_client';
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\SettingClientFactory::new();
    }

    public function getCorporateNameRequiredAttribute()
	{
		return ($this->corporate_name)?'required':'nullable';
	}

	public function getCpfCnpjRequiredAttribute()
	{
		return ($this->cpf_cnpj)?'required':'nullable';
	}

	public function getBuyerRequiredAttribute()
	{
		return ($this->buyer)?'required':'nullable';
	}

	public function getEmailRequiredAttribute()
	{
		return ($this->email)?'required':'nullable';
	}

	public function getPhoneRequiredAttribute()
	{
		return ($this->phone)?'required':'nullable';
	}

	public function getValidationCpfCnpjActiveAttribute()
	{
		return ($this->validation_cpf_cnpj)?'cpf_cnpj':'';
	}

    /* repository */
    public static function get(){
        return SettingClient::first();
    }


}
