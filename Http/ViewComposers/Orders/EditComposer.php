<?php

namespace Modules\Dashboard\Http\ViewComposers\Orders;

use Modules\Dashboard\Entities\Order;
use Modules\Dashboard\Entities\Client;
use Modules\Dashboard\Entities\Saller;
use Modules\Dashboard\Entities\Status;
use Modules\Dashboard\Entities\Payment;
use Modules\Client\Repositories\ClientRepository;
use Modules\Dashboard\Services\ViewComposer\ServiceComposer;

class EditComposer extends ServiceComposer {

    private $tab;
    private $order;
    private $select_statuses;
    private $select_sallers;
    private $select_payments;

    public function assign($view){
        $this->tab();
        $this->order();
        $this->select_statuses();
        $this->select_sallers();
        $this->select_payments();
    }


    private function tab(){
        $this->tab = request()->route('tab');
    }


    private function order(){
        $this->order = request()->route('order');
    }


    private function select_statuses(){
        $this->select_statuses = Status::all()->pluck('name', 'id');
    }

    private function select_sallers(){
        $this->select_sallers = Saller::all()->pluck('name', 'id');
    }

    private function select_payments(){
        $this->select_payments = Payment::all()->pluck('description', 'id');
    }

    public function view($view){
        $view->with('tab', $this->tab);
        $view->with('order', $this->order);
        $view->with('select_statuses', $this->select_statuses);
        $view->with('select_sallers', $this->select_sallers);
        $view->with('select_payments', $this->select_payments);
    }

}