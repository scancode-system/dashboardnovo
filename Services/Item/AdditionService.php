<?php

namespace Modules\Dashboard\Services\Item;

use Modules\Dashboard\Entities\Item;

class AdditionService {


	public function __invoke(Item $item)
    {
		return $item->order->order_payment->addition;
	}

}