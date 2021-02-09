<?php

namespace Modules\Dashboard\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Dashboard\Database\Seeders\SallerTableSeeder;
use Modules\Dashboard\Database\Seeders\PaymentTableSeeder;
use Modules\Dashboard\Database\Seeders\ShippingTableSeeder;

class DashboardDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(SallerTableSeeder::class);
        $this->call(PaymentTableSeeder::class);
        $this->call(ShippingTableSeeder::class);
    }
}
