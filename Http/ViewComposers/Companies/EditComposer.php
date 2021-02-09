<?php

namespace Modules\Dashboard\Http\ViewComposers\Companies;


use Modules\Dashboard\Entities\Company;
use Modules\Dashboard\Services\ViewComposer\ServiceComposer;


class EditComposer extends ServiceComposer {

    private $company;
    private $tab;

    public function assign($view){
        $this->tab();
        $this->company();
    }

    private function tab(){
        $this->tab = request()->route('tab');
    }
    
    private function company(){
        $this->company =  Company::get();
    }


    public function view($view){
        $view->with('company', $this->company);
        $view->with('tab', $this->tab);
    }

}