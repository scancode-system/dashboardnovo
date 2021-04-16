<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends Model
{
    use HasFactory;

    protected $fillable = ['value'];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\ColorFactory::new();
    }

    /**repository */
    public static function loadByValue($value){
        return Color::where('value', $value)->first();
    }

}
