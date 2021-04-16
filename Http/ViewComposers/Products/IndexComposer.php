<?php

namespace Modules\Dashboard\Http\ViewComposers\Products;

use Modules\Dashboard\Entities\Product;
use Modules\Product\Repositories\ProductRepository;
use Modules\Dashboard\Services\ViewComposer\ServiceComposer;

class IndexComposer extends ServiceComposer {

    private $search;
    private $products;

    public function assign($view){
        $this->search();
        $this->products();
    }


    private function search(){
        if(isset(request()->search)){
            $this->search = request()->search;
        } else {
            $this->search = '';
        }
    }


    private function products(){
        $this->products = Product::search($this->search);
    }


    public function view($view){
        $view->with('products', $this->products);
        $view->with('search', $this->search);
    }

}