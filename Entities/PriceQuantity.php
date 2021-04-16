<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriceQuantity extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'price', 'qty'];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\PriceQuantityFactory::new();
    }

    /**repository */
    public static function destroyAllByProduct(Product $product){
        $price_quantities = $product->price_quantities;
        foreach($price_quantities as $price_quantity){
            $price_quantity->delete();
        }
    }

}
