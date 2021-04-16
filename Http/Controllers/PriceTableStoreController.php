<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Entities\PriceTable;

class PriceTableStoreController extends Controller
{

    public function __invoke(Request $request)
    {
        PriceTable::create($request->all());
        return back()->with('success', 'Tabela de preço cadastrado.');
    }

}
