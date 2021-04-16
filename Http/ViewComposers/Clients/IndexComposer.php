<?php

namespace Modules\Dashboard\Http\ViewComposers\Clients;

use Modules\Dashboard\Entities\Client;
use Modules\Client\Repositories\ClientRepository;
use Modules\Dashboard\Services\ViewComposer\ServiceComposer;

class IndexComposer extends ServiceComposer {

    private $search;
    private $clients;

    public function assign($view){
        $this->search();
        $this->clients();
    }


    private function search(){
        if(isset(request()->search)){
            $this->search = request()->search;
        } else {
            $this->search = '';
        }
    }


    private function clients(){
        $this->clients = Client::search($this->search);
    }


    public function view($view){
        $view->with('clients', $this->clients);
        $view->with('search', $this->search);
    }

}