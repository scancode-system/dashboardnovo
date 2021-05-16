<?php

namespace Modules\Dashboard\Providers;

use Modules\Dashboard\Entities\Item;
use Modules\Dashboard\Entities\Order;
use Modules\Dashboard\Entities\Saller;
use Illuminate\Support\ServiceProvider;
use Modules\Dashboard\Entities\OrderPayment;
use Modules\Dashboard\Entities\Product;
use Modules\Dashboard\Observers\ItemObserver;
use Modules\Dashboard\Observers\OrderObserver;
use Modules\Dashboard\Observers\OrderPaymentObserver;
use Modules\Dashboard\Observers\SallerObserver;
use Modules\Dashboard\Observers\ProductObserver;


class ObserverServiceProvider extends ServiceProvider {

	public function boot() {
		Saller::observe(SallerObserver::class);
		Product::observe(ProductObserver::class);
		Order::observe(OrderObserver::class);
		Item::observe(ItemObserver::class);
		OrderPayment::observe(OrderPaymentObserver::class);
	}

	public function register() {
        //
	}

}
