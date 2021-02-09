<?php

namespace Modules\Dashboard\Http\ViewComposers\Saller;

use Modules\Dashboard\Services\ViewComposer\ServiceComposer;
use Modules\Dashboard\Entities\Saller;

class IndexComposer extends ServiceComposer {

    private $search;
    private $sallers;

    public function assign($view){
        $this->search();
        $this->sallers();
    }


    private function search(){
        if(isset(request()->search)){
            $this->search = request()->search;
        } else {
            $this->search = '';
        }
    }


    private function sallers(){
        $this->sallers = Saller::search($this->search);
    }


    public function view($view){
        $view->with('sallers', $this->sallers);
        $view->with('search', $this->search);
    }

}