<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\ProductCategoryFactory::new();
    }

    /**repository */
    public static function loadByName($name){
        return ProductCategory::where('name', $name)->first();
    }
}
