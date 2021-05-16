<?php

namespace Modules\Dashboard\Services\Price;

use Modules\Dashboard\Entities\Item;
use Modules\Dashboard\Entities\ProductPriceTable;

class PriceService {


	public function __invoke(Item $item)
    {
		$price = $item->price;
		$price = $this->price_quantities($item, $price);
		$price = $this->price_tables($item, $price);
		return $price;
	}
	
	private function price_quantities(Item $item, $price){
		$qty = $item->qty;
		$price_quantities = $item->product->price_quantities;
		$price_quantities = $price_quantities->sortBy('qty');
		foreach ($price_quantities as $price_quantity) 
		{
			if($qty >= $price_quantity->qty) {
				$price = $price_quantity->price;
			}
		}
		return $price;
	}

	private function price_tables(Item $item, $price){
		if($item->order->client_id){
			if($item->order->client->price_table_id){
				$product_price_table = ProductPriceTable::loadByPriceTableIdAndProductId($item->order->client->price_table_id, $item->product_id);
				if($product_price_table){
					$price = $product_price_table->price;
				}

			}
		}
		return $price;
	}


}