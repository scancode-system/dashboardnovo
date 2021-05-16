<?php

namespace Modules\Dashboard\Http\ViewComposers\Settings;

use App\Models\User;
use Modules\Dashboard\Entities\PdfLayout;
use Modules\Dashboard\Entities\SettingPdf;
use Modules\Dashboard\Entities\SettingOrder;
use Modules\Dashboard\Entities\SettingClient;
use Modules\Dashboard\Entities\SettingPdfColumn;
use Modules\Dashboard\Services\ViewComposer\ServiceComposer;


class IndexComposer extends ServiceComposer {

    private $tab;
    private $users;
    private $setting_client;
    private $setting_order;

    private $setting_pdf;
    private $setting_pdf_columns;
    private $pdf_layouts;

    public function assign($view){
        $this->tab();
        $this->users();
        $this->setting_client();
        $this->setting_order();

        $this->settingPdf();
        $this->pdfLayouts();
        $this->settingPdfColumns();
    }

    private function tab(){
        $this->tab = request()->route('tab');
    }

    private function users(){
        $this->users = User::all();
    }

    private function setting_client(){
        $this->setting_client = SettingClient::get();
    }

    private function setting_order(){
        $this->setting_order = SettingOrder::get();
    }

    private function settingPdfColumns()
    {
        $this->setting_pdf_columns = SettingPdfColumn::all();
    }

    private function settingPdf()
    {
        $this->setting_pdf = SettingPdf::get();
    }


    private function pdfLayouts()
    {
        $this->pdf_layouts = PdfLayout::all();
    }
    
    public function view($view){
        $view->with('tab', $this->tab);
        $view->with('users', $this->users);
        $view->with('setting_client', $this->setting_client);
        $view->with('setting_order', $this->setting_order);

        $view->with('setting_pdf', $this->setting_pdf);
        $view->with('setting_pdf_columns', $this->setting_pdf_columns);
        $view->with('pdf_layouts', $this->pdf_layouts);
    }

}