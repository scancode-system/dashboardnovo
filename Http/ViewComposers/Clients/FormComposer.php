<?php

namespace Modules\Dashboard\Http\ViewComposers\Clients;

use Modules\Dashboard\Entities\PriceTable;
use Modules\Dashboard\Entities\Shipping;
use Modules\Dashboard\Services\ViewComposer\ServiceComposer;


class FormComposer extends ServiceComposer {

    private $shippings;
    private $price_tables;

    public function assign($view){
        $this->shippings();
        $this->price_tables();
    }


    private function shippings(){
        $this->shippings = Shipping::all()->pluck('name', 'id');
    }

    private function price_tables(){
        $this->price_tables = PriceTable::all();
    }


    public function view($view){
        $view->with('shippings', $this->shippings);
        $view->with('price_tables', $this->price_tables);
    }

}