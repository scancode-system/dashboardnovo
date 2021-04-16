<?php

namespace Modules\Dashboard\Observers;

use Modules\Dashboard\Entities\Product;
use Modules\Dashboard\Entities\ProductStock;

class ProductObserver
{

	public function created(Product $product)
	{
        ProductStock::create(['product_id' => $product->id]);
	}	


}
