<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Dashboard\Entities\PriceTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductPriceTable extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'price_table_id', 'price'];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\ProductPriceTableFactory::new();
    }

    public function price_table()
	{
		return $this->belongsTo(PriceTable::class);
    }

    /**repository */
    public static function destroyAllByProduct(Product $product){
        $product_price_tables = $product->product_price_tables;
        foreach($product_price_tables as $product_price_table){
            $product_price_table->delete();
        }
    }
}
