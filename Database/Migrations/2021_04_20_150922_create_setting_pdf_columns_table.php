<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Dashboard\Entities\SettingPdfColumn;

class CreateSettingPdfColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_pdf_columns', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('alias');
            $table->boolean('show')->default(true);
            $table->timestamps();
        });

        SettingPdfColumn::create(['name' => 'image', 'alias' => 'Imagem']);
        SettingPdfColumn::create(['name' => 'discount', 'alias' => 'Desconto']);
        SettingPdfColumn::create(['name' => 'addition', 'alias' => 'Acrescimo']);
        SettingPdfColumn::create(['name' => 'ipi', 'alias' => 'Ipi']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_pdf_columns');
    }
}
