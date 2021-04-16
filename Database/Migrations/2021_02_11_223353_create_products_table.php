<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('sku')->index();
            $table->string('barcode')->unique();

            $table->string('description');
            $table->decimal('price', 10, 2);

            $table->integer('min_qty')->default(1);
            $table->decimal('discount_limit', 10, 2)->default(100);
            $table->integer('multiple')->default(1);

            $table->decimal('ipi', 10, 2)->default(0);

           $table->unsignedBigInteger('product_category_id');
            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('restrict')->onUpdate('restrict');

            $table->unsignedBigInteger('subsidiary_id')->nullable();
            $table->foreign('subsidiary_id')->references('id')->on('subsidiaries')->onDelete('set null')->onUpdate('cascade');

            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('set null')->onUpdate('cascade');

            $table->unsignedBigInteger('size_id')->nullable();
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('set null')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
