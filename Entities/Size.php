<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['value'];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\SizeFactory::new();
    }

    /**repository */
    public static function loadByValue($value){
        return Size::where('value', $value)->first();
    }
}
