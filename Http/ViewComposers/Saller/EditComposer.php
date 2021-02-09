<?php

namespace Modules\Dashboard\Http\ViewComposers\Saller;


use Modules\Dashboard\Services\ViewComposer\ServiceComposer;


class EditComposer extends ServiceComposer {

    private $saller;

    public function assign($view){
        $this->saller();
    }


    private function saller(){
        $this->saller = request()->route('saller');
    }


    public function view($view){
        $view->with('saller', $this->saller);
    }

}