<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Dashboard\Entities\SettingPdf;

class CreateSettingPdfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_pdf', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->integer('margin_top')->default(10);
            $table->text('statement_responsibility')->nullable();
            $table->text('global_observation')->nullable();

            $table->timestamps();
        });

        SettingPdf::create(['title' => '', 'global_observation' => '', 'statement_responsibility' => '']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_pdf');
    }
}
