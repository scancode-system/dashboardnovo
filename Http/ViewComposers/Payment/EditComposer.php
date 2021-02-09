<?php

namespace Modules\Dashboard\Http\ViewComposers\Payment;


use Modules\Dashboard\Services\ViewComposer\ServiceComposer;


class EditComposer extends ServiceComposer {

    private $payment;

    public function assign($view){
        $this->payment();
    }


    private function payment(){
        $this->payment = request()->route('payment');
    }


    public function view($view){
        $view->with('payment', $this->payment);
    }

}