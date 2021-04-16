<?php

namespace Modules\Dashboard\Http\ViewComposers\Products;


use Modules\Dashboard\Entities\PriceTable;
use Modules\Product\Repositories\ProductCategoryRepository;
use Modules\Dashboard\Services\ViewComposer\ServiceComposer;


class EditComposer extends ServiceComposer {

    private $product;
    private $product_stock;
    private $price_tables;

    public function assign($view){
        $this->product();
        $this->product_stock();
        $this->price_tables();
    }


    private function product(){
        $this->product = request()->route('product');
    }

    private function product_stock(){
        $this->product_stock = $this->product->product_stock;
    }


    private function price_tables(){
        $this->price_tables = PriceTable::all();
    }


    public function view($view){
        $view->with('product', $this->product);
        $view->with('product_stock', $this->product_stock);
        $view->with('price_tables', $this->price_tables);
    }

}