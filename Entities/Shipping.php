<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\ShippingFactory::new();
    }

    /* repository */
    public static function loadByName($name){
        return Shipping::where('name', $name)->first();
    }
}
