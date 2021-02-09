<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Entities\Saller;
use Modules\Dashboard\Http\Requests\Saller\SallerRequest;

class SallerController extends Controller
{
    
    public function index(Request $request){
        return view('dashboard::sallers.index');
    }

    public function create()
    {
        return view('dashboard::sallers.create');
    }

    public function edit(Request $request, Saller $saller)
    {
        return view('dashboard::sallers.edit');
    }

    public function store(SallerRequest $request){
        Saller::create($request->all());
        return redirect()->route('sallers.index')->with('success', 'Representante cadastrado.');
    }

    public function update(SallerRequest $request, Saller $saller){
        $saller->update($request->all());
        return redirect()->route('sallers.edit', $saller->id)->with('success', 'Representante atualizado.');
    }

    public function destroy(Request $request, Saller $saller){
        $saller->delete();
        return back()->with('success', 'Representante deletado.');
    }
    
}
