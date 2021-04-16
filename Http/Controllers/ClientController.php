<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Entities\Client;
use Modules\Dashboard\Entities\Shipping;
use Modules\Dashboard\Http\Requests\Client\ClientRequest;

 
class ClientController extends Controller
{

    public function index(Request $request){
        return view('dashboard::clients.index');
    }


    public function create()
    {
        return view('dashboard::clients.create');
    }

    public function edit(Request $request, Client $client)
    {
        return view('dashboard::clients.edit');
    }


    public function store(ClientRequest $request){
        Client::create($request->all());
        return redirect()->route('clients.index')->with('success', 'Cliente cadastrado.');
    }

    public function storeShipping(Request $request){
        Shipping::create($request->all());
		return back()->with('success', 'Transportadora cadastrado.');
    }


    public function update(ClientRequest $request, Client $client){
        $client->update($request->all());
        return back()->with('success', 'Cliente atualizado.');
    }


    public function destroy(Request $request, Client $client){
        $client->delete();
        return back()->with('success', 'Clinte deletado.');
    }

    public function import(Request $request)
    {
        return view('client::import');
    }

    public function select(Request $request, $text)
    {
        $clients =  Client::where('id', $text)->
        orWhere('corporate_name', 'like', '%'.$text.'%')->
        orWhere('fantasy_name', 'like', '%'.$text.'%')->
        orWhere('cpf_cnpj', $text)->limit(30)->get();

        $response = [];
        foreach ($clients as $client) {
            array_push($response, ['id' => $client->id, 'text' => $client->corporate_name]);
        }

        return $response;
    }

}
