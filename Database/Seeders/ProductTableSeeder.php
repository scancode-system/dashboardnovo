<?php

namespace Modules\Dashboard\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Dashboard\Entities\Client;
use Illuminate\Database\Eloquent\Model;
use Modules\Dashboard\Entities\Product;
use Modules\Dashboard\Entities\ProductCategory;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Product::factory()->times(30)->create();
    }
}