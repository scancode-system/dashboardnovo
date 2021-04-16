<?php

namespace Modules\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidationServiceProvider extends ServiceProvider 
{

	public function boot() 
	{
		$this->cpf_cnpj();
	}

	public function register() 
	{

	}

	private function cpf_cnpj(){
		Validator::extend('cpf_cnpj', function ($attribute, $value, $parameters, $validator) {
			$value = preg_replace('/[^0-9]/', '', (string) $value);

			if (strlen($value) == 14){
				$cnpj = $value;
				for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
				{
					$soma += $cnpj[$i] * $j;
					$j = ($j == 2) ? 9 : $j - 1;
				}
				$resto = $soma % 11;
				if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
					return false;

				for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
				{
					$soma += $cnpj[$i] * $j;
					$j = ($j == 2) ? 9 : $j - 1;
				}

				$resto = $soma % 11;
				return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);

			} else if (strlen($value) == 11){
				$cpf = $value;

				for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--){
					$soma += $cpf[$i] * $j;
				}

				$resto = $soma % 11;
				if ($cpf[9] != ($resto < 2 ? 0 : 11 - $resto)){
					return false;
				}

				for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--){
					$soma += $cpf[$i] * $j;
				}

				$resto = $soma % 11;
				return $cpf[10] == ($resto < 2 ? 0 : 11 - $resto);

			} else {
				return false;
			}


			return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
			return false;
		});
	}

}
