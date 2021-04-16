<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Dashboard\Entities\SettingOrder;
use Modules\Dashboard\Entities\SettingClient;

class SettingController extends Controller
{

    public function index()
    {
        return view('dashboard::settings.index');
    }

    public function updateClient(Request $request){
        (SettingClient::get())->update($request->all());
        return back()->with('success', 'Configuração atualizada.');
    }

    public function updateOrder(Request $request){
        (SettingOrder::get())->update($request->all());
        return back()->with('success', 'Configuração atualizada.');
    }

}
