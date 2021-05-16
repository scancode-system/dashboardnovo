<?php

namespace Modules\Dashboard\Providers;

use Illuminate\Support\Facades\Gate;
use Modules\Dashboard\Entities\Item;
use Modules\Dashboard\Entities\Order;
use Modules\Dashboard\Entities\Status;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        
        Gate::define('order-locked-gate', function ($user, Order $order = null, Item $item = null) {
            if($item instanceof Item){
                $order = $item->order;
            }
            if($order instanceof Order){
                return ($order->status_id == Status::OPEN);
            }
        });
    }
}
