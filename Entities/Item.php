<?php

namespace Modules\Dashboard\Entities;

use Modules\Dashboard\Entities\Order;
use Illuminate\Database\Eloquent\Model;
use Modules\Dashboard\Entities\Product;
use Modules\Dashboard\Entities\ItemStock;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'price', 'qty', 'discount', 'addition', 'observation'];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\ItemFactory::new();
    }

    /**relationship */
    public function product()
	{
		return $this->belongsTo(Product::class);
	}
	
	public function order()
	{
		return $this->belongsTo(Order::class);
	}
	
	public function item_stock()
	{
		return $this->hasOne(ItemStock::class);
    }

    /**repository */
	public static function search($order = null, $search = '', $limit = 10){
		
		$items =  Item::orWhereHas('product', function($query) use ($search) {
			$query->where('description', 'like', '%'.$search.'%')->
			orWhere('sku', 'like', '%'.$search.'%');
		})->
		with(['product']);
		if($order){
			$items->where('order_id', $order->id);
		}
		$items = $items->paginate($limit);
		$items->appends(request()->query());
		return $items;
	}

	public static function updateItemsAdditionByOrder(Order $order, $addition){
		foreach($order->items as $item){
			$item->update(['addition' => $addition]);
		}
	}

	public function updateDiscount($discount){
		$this->discount = $discount;
		$this->save();
	}

	public static function loadItemsClosedOrders(){
		return Item::
		whereHas('order', function ($query) {
			$query->where('status_id', Status::COMPLETED);
		})->
		orderBy('order_id')->
		get();
	}

	public static function loadItemsByProductWithClosedOrders(Product $product){
		return Item::
		where('product_id', $product->id)->
		whereHas('order', function ($query) {
			$query->where('status_id', Status::COMPLETED);
		})->get();
	}

	/**accessors */
	public function getDiscountValueAttribute($value)
	{
		return ($this->price*$this->discount)/100;
	}


	public function getAdditionValueAttribute($value)
	{
		return (($this->price)*$this->addition)/100;
	}


	public function getIpiValueAttribute($value){
		$final_price = $this->price-$this->discount_value+$this->addition_value;
		return $final_price*($this->ipi/100);
	}

	public function getPriceNetAttribute($value)
	{
		return $this->price-$this->discount_value+$this->addition_value+$this->ipi_value;
	}


	public function getTotalGrossAttribute($value)
	{
		return $this->price*$this->qty;
	}
	
	public function getTotalGrossNowAttribute($value)
	{
		return $this->price*$this->item_stock->qty_now;
	}

	public function getTotalGrossFutureAttribute($value)
	{
		return $this->price*$this->item_stock->qty_future;
	}

	public function getTotalDiscountValueAttribute($value)
	{
		return $this->discount_value*$this->qty;
	}

	public function getTotalDiscountNowValueAttribute($value)
	{
		return $this->discount_value*$this->item_stock->qty_now;
	}

	public function getTotalDiscountFutureValueAttribute($value)
	{
		return $this->discount_value*$this->item_stock->qty_future;
	}


	public function getTotalAdditionValueAttribute($value)
	{
		return $this->addition_value*$this->qty;
	}

	public function getTotalAdditionValueNowAttribute($value)
	{
		return $this->addition_value*$this->item_stock->qty_now;
	}

	public function getTotalAdditionValueFutureAttribute($value)
	{
		return $this->addition_value*$this->item_stock->qty_future;
	}


	public function getTotalIpiValueAttribute($value)
	{
		return $this->ipi_value*$this->qty;
	}

	public function getTotalAttribute($value)
	{
		return $this->price_net*$this->qty;
	}

	public function getTotalNowAttribute($value)
	{
		return $this->price_net*$this->item_stock->qty_now;
	}

	public function getTotalFutureAttribute($value)
	{
		return $this->price_net*$this->item_stock->qty_future;
	}

}
