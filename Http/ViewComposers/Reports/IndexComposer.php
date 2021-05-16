<?php

namespace Modules\Dashboard\Http\ViewComposers\Reports;

use Modules\Dashboard\Entities\ReportCategory;
use Modules\Dashboard\Services\ViewComposer\ServiceComposer;

class IndexComposer extends ServiceComposer {

    private $report_categories;

    public function assign($view){
        $this->report_categories();
    }

    private function report_categories(){
        $this->report_categories = ReportCategory::with('reports')->get();
    }


    public function view($view){
        $view->with('report_categories', $this->report_categories);
    }

}