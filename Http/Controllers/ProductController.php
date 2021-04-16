<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Entities\Size;
use Modules\Dashboard\Entities\Color;
use Illuminate\Support\Facades\Storage;
use Modules\Dashboard\Entities\Product;
use Illuminate\Contracts\Support\Renderable;
use Modules\Dashboard\Entities\Subsidiary;
use Modules\Dashboard\Http\Requests\Product\ProductRequest;

class ProductController extends Controller
{


    public function index(Request $request)
    {
        return view('dashboard::products.index');
    }


    public function create()
    {
        return view('dashboard::products.create');
    }

    public function edit(Request $request, Product $product)
    {
        return view('dashboard::products.edit');
    }


    public function store(ProductRequest $request)
    {
        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Produto cadastrado.');
    }

    public function storeColor(Request $request)
    {
        Color::create($request->all());
        return back()->with('success', 'Cor cadastrado.');
    }

    public function storeSize(Request $request)
    {
        Size::create($request->all());
        return back()->with('success', 'Tamanho cadastrado.');
    }

    public function storeSubsidiary(Request $request)
    {
        Subsidiary::create($request->all());
        return back()->with('success', 'Filial cadastrado.');
    }


    public function storeImage(Request $request, Product $product)
    {
        Storage::disk('public')->putFileAs('produtos', $request->file, $product->sku . '.jpg');
    }


    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());
        return redirect()->route('products.edit', $product->id)->with('success', 'Produto atualizado.');
    }


    public function destroy(Request $request, Product $product)
    {
        $product->delete();
        return back()->with('success', 'Produto deletado.');
    }

    public function import(Request $request)
    {
        return view('product::import');
    }

    public function importImages(Request $request)
    {
        Storage::disk('public')->putFileAs('produtos', $request->file, $request->file->getClientOriginalName());
    }

    public function select(Request $request, $text)
    {
        $products = Product::where('description', 'like', '%' . $text . '%')->orWhere('sku', 'like', '%' . $text . '%')->limit(30)->get();

        $response = [];
        foreach ($products as $product) {
            array_push($response, ['id' => $product->id, 'text' => $product->description]);
        }

        return $response;
    }
}
