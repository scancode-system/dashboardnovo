<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            $table->string('corporate_name')->nullable();
            $table->string('fantasy_name')->nullable();
            $table->string('cpf_cnpj')->nullable();
            $table->string('buyer')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->string('street')->nullable();
            $table->integer('number')->nullable();
            $table->string('apartment')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('city')->nullable();
            $table->string('st', 2)->nullable();
            $table->string('postcode', 8)->nullable();

            $table->unsignedBigInteger('shipping_id')->nullable();
            $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('set null')->onUpdate('cascade');

            $table->unsignedBigInteger('price_table_id')->nullable();
            $table->foreign('price_table_id')->references('id')->on('price_tables')->onDelete('set null')->onUpdate('cascade');

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
        Schema::dropIfExists('clients');
    }
}
