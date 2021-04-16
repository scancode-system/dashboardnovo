<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Entities\Product;
use Illuminate\Contracts\Support\Renderable;
use Modules\Dashboard\Entities\ProductPriceTable;
use Modules\Dashboard\Http\Requests\Product\ProductPriceTableRequest;

class ProductPriceTableController extends Controller
{

    public function store(ProductPriceTableRequest $request, Product $product){
        ProductPriceTable::create($request->all()+['product_id' => $product->id]);
        return back()->with('success', 'Tabela de preço no produto adicionado.');
    }

    public function destroy(Request $request, ProductPriceTable $product_price_table){
        $product_price_table->delete();
        return back()->with('success', 'Tabela de preço do produto removido.');
    }

}
