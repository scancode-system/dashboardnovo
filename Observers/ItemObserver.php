<?php

namespace Modules\Dashboard\Observers;

use Modules\Dashboard\Entities\Item;
use Modules\Dashboard\Entities\Product;
use Modules\Dashboard\Entities\ItemStock;
use Modules\Dashboard\Entities\OrderPayment;
use Modules\Dashboard\Entities\ProductStock;
use Modules\Dashboard\Services\Price\PriceService;
use Modules\Dashboard\Services\Stock\StockService;
use Modules\Dashboard\Services\Item\AdditionService;
use Modules\Dashboard\Services\Discount\DiscountService;

class ItemObserver
{

	public function saving(Item $item)
	{
		$item->price = (new PriceService())($item);
		$item->discount = (new DiscountService())($item);
		$item->addition = (new AdditionService())($item);
	}

	public function created(Item $item)
	{
		ItemStock::create(['item_id' => $item->id]);
		(new StockService())($item, true);
	}

	public function updating(Item $item)
	{
		(new StockService())($item);
	}

	public function deleting(Item $item)
	{
		$item->qty = 0;
		(new StockService())($item);
	}

}
