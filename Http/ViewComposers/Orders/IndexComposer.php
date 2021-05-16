<?php

namespace Modules\Dashboard\Http\ViewComposers\Orders;

use Modules\Dashboard\Entities\Order;
use Modules\Dashboard\Entities\Client;
use Modules\Dashboard\Entities\Saller;
use Modules\Client\Repositories\ClientRepository;
use Modules\Dashboard\Services\ViewComposer\ServiceComposer;

class IndexComposer extends ServiceComposer {

    private $search;
    private $orders;
    private $select_sallers;

    public function assign($view){
        $this->search();
        $this->orders();
        $this->select_sallers();
    }


    private function search(){
        if(isset(request()->search)){
            $this->search = request()->search;
        } else {
            $this->search = '';
        }
    }


    private function orders(){
        $this->orders = Order::search($this->search);
    }

    private function select_sallers(){
        $this->select_sallers = Saller::all()->pluck('name', 'id');
    }


    public function view($view){
        $view->with('orders', $this->orders);
        $view->with('search', $this->search);
        $view->with('select_sallers', $this->select_sallers);
    }

}