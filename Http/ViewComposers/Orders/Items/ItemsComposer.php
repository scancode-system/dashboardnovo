<?php

namespace Modules\Dashboard\Http\ViewComposers\Orders\Items;

use Modules\Dashboard\Entities\Item;
use Modules\Dashboard\Entities\Product;
use Modules\Order\Repositories\ItemRepository;
use Modules\Product\Repositories\OrderRepository;
use Modules\Product\Repositories\ProductRepository;
use Modules\Dashboard\Services\ViewComposer\ServiceComposer;


class ItemsComposer extends ServiceComposer {


    private $search;
    private $items;
    private $select_products;


    public function assign($view){
        $this->search();
        $this->items();
        $this->select_products();
    }


    private function search(){
        if(isset(request()->search)){
            $this->search = request()->search;
        } else {
            $this->search = '';
        }
    }


    private function items(){
        $this->items = Item::search(request()->route('order'), $this->search);
    }


    private function select_products(){
        $products = Product::all();
        $select_products = [];
        foreach ($products as $product) 
        {
            $select_products[$product->id] = $product->sku.'/'.$product->description;
        }
        $this->select_products = $select_products;
    }


    public function view($view){
        $view->with('search', $this->search);
        $view->with('items', $this->items);
        $view->with('select_products', $this->select_products);
    }

}