<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Modules\Dashboard\Entities\SettingOrder;
use Illuminate\Database\Migrations\Migration;

class CreateSettingOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_order', function (Blueprint $table) {
            $table->id();

            $table->integer('order_start')->default(1);
            $table->boolean('buyer')->default(0); 

            $table->integer('number_copies')->default(2);
            $table->boolean('auto')->default(true);

            $table->timestamps();
        });

        SettingOrder::create([]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_order');
    }
}
