<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Modules\Dashboard\Entities\ProductStock;
use Modules\Dashboard\Entities\PriceQuantity;
use Modules\Dashboard\Entities\ProductCategory;
use Modules\Dashboard\Entities\ProductPriceTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'sku', 'barcode', 'description', 'price', 'min_qty', 'discount_limit', 'multiple', 'product_category_id', 'ipi', 'color_id', 'size_id', 'subsidiary_id'];
    protected $appends = ['image'];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\ProductFactory::new();
    }

    /** relationships */
    public function product_stock()
	{
		return $this->hasOne(ProductStock::class);
    }

    public function product_category()
	{
		return $this->belongsTo(ProductCategory::class);
    }

    public function price_quantities()
	{
		return $this->hasMany(PriceQuantity::class);
    }

    public function product_price_tables()
	{
		return $this->hasMany(ProductPriceTable::class);
    }
    
    /** mutators */
    public function getImageAttribute()
	{
		if(Storage::disk('public')->exists('produtos/'.$this->sku.'.jpg'))
		{
			return 'storage/produtos/'.$this->sku.'.jpg'; 
		} elseif(Storage::disk('public')->exists('produtos/'.$this->barcode.'.jpg'))
		{
			return 'storage/produtos/'.$this->barcode.'.jpg';
		}
		return 'modules/dashboard/img/noimage.png';
	}

    /** repository */
    public static function search($search, $limit = 10){
        $products =  Product::where('description', 'like', '%'.$search.'%')->orWhere('sku', 'like', '%'.$search.'%')->paginate($limit);
		$products->appends(request()->query());
		return $products;
    }

    public static function loadByUniqueKeys($id, $barcode){
		return Product::where('id', $id)->orWhere('barcode', $barcode)->first();
	}
}
