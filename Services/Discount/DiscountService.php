<?php

namespace Modules\Dashboard\Services\Discount;

use Modules\Dashboard\Entities\Item;
use Modules\Dashboard\Entities\ProductPriceTable;

class DiscountService {


	public function __invoke(Item $item)
    {
		$discount = $item->discount;

		$limit_max = $item->product->discount_limit;
		$limit_min = $item->order->order_payment->discount;

		if($limit_min > $limit_max)
		{
			$limit_min = $limit_max;
		}

		if($limit_max < $item->discount){
			$discount = $limit_max;
		}
		if($limit_min > $item->discount){
			$discount = $limit_min;	
		}

		return $discount;
		//event(new ItemAfterDiscountParseEvent($item));
	}

}