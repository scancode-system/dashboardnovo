<?php

namespace Modules\Dashboard\Http\ViewComposers\Products;


use Modules\Dashboard\Entities\Size;
use Modules\Dashboard\Entities\Color;
use Modules\Dashboard\Entities\PriceTable;
use Modules\Dashboard\Entities\ProductCategory;
use Modules\Dashboard\Entities\Subsidiary;
use Modules\Product\Repositories\ProductCategoryRepository;
use Modules\Dashboard\Services\ViewComposer\ServiceComposer;


class FormComposer extends ServiceComposer {

    private $product_categories;
    private $colors;
    private $sizes;
    private $subsidiaries;

    public function assign($view){
        $this->product_categories();
        $this->colors();
        $this->sizes();
        $this->subsidiaries();
    }


    private function product_categories(){
        $this->product_categories = ProductCategory::all();
    }

    private function colors(){
        $this->colors = Color::all();
    }

    private function sizes(){
        $this->sizes = Size::all();
    }

    private function subsidiaries(){
        $this->subsidiaries = Subsidiary::all();
    }

    public function view($view){
        $view->with('product_categories', $this->product_categories);
        $view->with('colors', $this->colors);
        $view->with('sizes', $this->sizes);
        $view->with('subsidiaries', $this->subsidiaries);
    }

}