<?php

namespace Modules\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Dashboard\Entities\Saller;
use Modules\Dashboard\Observers\SallerObserver;


class ObserverServiceProvider extends ServiceProvider {

	public function boot() {
		Saller::observe(SallerObserver::class);
	}

	public function register() {
        //
	}

}
