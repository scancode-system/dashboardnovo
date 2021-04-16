<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Dashboard\Entities\ProductStock;
use Modules\Dashboard\Http\Requests\Product\ProductStockRequest;

class ProductStockController extends Controller
{

    public function update(ProductStockRequest $request, ProductStock $product_stock)
    {
        $product_stock->update($request->all());
        return back()->with('success', 'Estoque atualizado.');
    }


}
