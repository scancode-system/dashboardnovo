<?php

use Illuminate\Support\Facades\Schema;
use Modules\Dashboard\Entities\Report;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('module');
            $table->string('export');
            $table->string('alias')->unique();

            $table->unsignedBigInteger('report_category_id');
            $table->foreign('report_category_id')->references('id')->on('report_categories')->onDelete('restrict')->onUpdate('restrict');
            $table->timestamps();
        });

        Report::createByCategory(['module' => 'Dashboard', 'export' => 'OrdersExport', 'alias' => 'Pedidos Simples'], 'Pedidos');
        Report::createByCategory(['module' => 'Dashboard', 'export' => 'OrdersFullExport', 'alias' => 'Pedidos Detalhado'], 'Pedidos');

        Report::createByCategory(['module' => 'Dashboard', 'export' => 'ItemsExport', 'alias' => 'Items Simples'], 'Items');
        Report::createByCategory(['module' => 'Dashboard', 'export' => 'ItemsFullExport', 'alias' => 'Items Detalhado'], 'Items');

        Report::createByCategory(['module' => 'Dashboard', 'export' => 'ProductsExport', 'alias' => 'Produtos Simples'], 'Produtos');
        Report::createByCategory(['module' => 'Dashboard', 'export' => 'ProductsFullExport', 'alias' => 'Produtos Detalhado'], 'Produtos');

        Report::createByCategory(['module' => 'Dashboard', 'export' => 'SallersExport', 'alias' => 'Representantes'], 'Representantes');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
