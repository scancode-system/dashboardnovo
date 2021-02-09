<?php

namespace Modules\Dashboard\Http\ViewComposers\Payment;

use Modules\Dashboard\Services\ViewComposer\ServiceComposer;
use Modules\Dashboard\Entities\Payment;

class IndexComposer extends ServiceComposer {

    private $search;
    private $payments;

    public function assign($view){
        $this->search();
        $this->payments();
    }


    private function search(){
        if(isset(request()->search)){
            $this->search = request()->search;
        } else {
            $this->search = '';
        }
    }


    private function payments(){
        $this->payments = Payment::search($this->search);
    }


    public function view($view){
        $view->with('payments', $this->payments);
        $view->with('search', $this->search);
    }

}