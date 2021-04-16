<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Dashboard\Entities\ProductCategory;

class ProductCategoryController extends Controller
{
 
    public function store(Request $request)
    {
        ProductCategory::create($request->all());
        return back()->with('success', 'Categoria cadastrado.');
    }


}
