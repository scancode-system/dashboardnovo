<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Entities\Product;
use Illuminate\Contracts\Support\Renderable;
use Modules\Dashboard\Entities\PriceQuantity;
use Modules\Dashboard\Http\Requests\Product\PriceQuantityRequest;

class PriceQuantityController extends Controller
{

    public function store(PriceQuantityRequest $request, Product $product){
        PriceQuantity::create($request->all()+['product_id' => $product->id]);
        return back()->with('success', 'Preço por quantidade criado.');
    }

    public function destroy(Request $request, PriceQuantity $price_quantity){
        $price_quantity->delete();
        return back()->with('success', 'Preço por quantidade removido.');
    }

}
