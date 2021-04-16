<?php

namespace Modules\Dashboard\Providers;

use Modules\Dashboard\Entities\Saller;
use Illuminate\Support\ServiceProvider;
use Modules\Dashboard\Entities\Product;
use Modules\Dashboard\Observers\SallerObserver;
use Modules\Dashboard\Observers\ProductObserver;


class ObserverServiceProvider extends ServiceProvider {

	public function boot() {
		Saller::observe(SallerObserver::class);
		Product::observe(ProductObserver::class);
	}

	public function register() {
        //
	}

}
