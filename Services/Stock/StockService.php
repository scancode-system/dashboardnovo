<?php

namespace Modules\Dashboard\Services\Stock;

use Exception;
use Modules\Dashboard\Entities\Item;

class StockService
{


	public function __invoke(Item $item, $remove = false)
	{
		try {
			$product_stock = $item->product->product_stock;
			$item_stock = $item->item_stock;

			if (!is_null($product_stock->qty_now)) {



				$qty = $item->qty - $item->getOriginal('qty');

				if ($qty >= 0) {
					$quantities = ($product_stock->take($qty));
					$item_stock->put($quantities['qty_now'], $quantities['qty_future']);
				} else {
					$quantities = ($item_stock->take($qty * (-1)));
					$product_stock->put($quantities['qty_now'], $quantities['qty_future']);
				}

				$product_stock->save();
				$item_stock->save();
			}
		} catch (Exception $e) {
			if ($remove) {
				$item->delete();
			}
			throw new Exception($e->getMessage());
		}
	}
}
