<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['cnpj', 'corporate_name', 'fantasy_name', 'state_registration', 'phone', 'email', 'street', 'number', 'apartment', 'neighborhood', 'city', 'st', 'postcode', 'logo'];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\CompanyFactory::new();
    }

    public static function get(){
        return Company::first();
    }
}
