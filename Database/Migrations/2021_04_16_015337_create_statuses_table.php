<?php

use Illuminate\Support\Facades\Schema;
use Modules\Dashboard\Entities\Status;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Status::insert([
            ['id' => 1, 'name' => 'Aberto'],
            ['id' => 2, 'name' => 'Concluído'],
            ['id' => 3, 'name' => 'Cancelado'],
            ['id' => 4, 'name' => 'Reservado']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
}
