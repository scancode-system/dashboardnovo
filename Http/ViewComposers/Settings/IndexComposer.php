<?php

namespace Modules\Dashboard\Http\ViewComposers\Settings;

use App\Models\User;
use Modules\Dashboard\Entities\SettingOrder;
use Modules\Dashboard\Entities\SettingClient;
use Modules\Dashboard\Services\ViewComposer\ServiceComposer;


class IndexComposer extends ServiceComposer {

    private $tab;
    private $users;
    private $setting_client;
    private $setting_order;

    public function assign($view){
        $this->tab();
        $this->users();
        $this->setting_client();
        $this->setting_order();
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
    
    public function view($view){
        $view->with('tab', $this->tab);
        $view->with('users', $this->users);
        $view->with('setting_client', $this->setting_client);
        $view->with('setting_order', $this->setting_order);
    }

}