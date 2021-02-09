<?php

namespace Modules\Dashboard\Http\ViewComposers\Layouts;

use Modules\Dashboard\Entities\Company;
use Modules\Dashboard\Repositories\CompanyRepository;
use Modules\Dashboard\Services\ViewComposer\ServiceComposer;

class MasterComposer extends ServiceComposer {

    private $company;


    public function assign($view){
        $this->company();
    }


    private function company(){
        $this->company = Company::get();
    }


    public function view($view){
        $view->with('company', $this->company);
    }

}