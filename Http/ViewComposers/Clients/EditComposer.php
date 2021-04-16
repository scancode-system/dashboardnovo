<?php

namespace Modules\Dashboard\Http\ViewComposers\Clients;


use Modules\Dashboard\Services\ViewComposer\ServiceComposer;
use Modules\Client\Repositories\ShippingCompanyRepository;

class EditComposer extends ServiceComposer
{

    private $client;

    public function assign($view)
    {
        $this->client();
    }


    private function client()
    {
        $this->client = request()->route('client');
    }


    public function view($view)
    {
        $view->with('client', $this->client);
    }
}
