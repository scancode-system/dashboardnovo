<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Modules\Dashboard\Entities\PdfLayout;
use Illuminate\Database\Migrations\Migration;

class CreatePdfLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdf_layouts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('description');
            $table->string('path');
            $table->boolean('selected')->default(false);
            $table->timestamps();
        });

        PdfLayout::create(['title' => 'Padrão', 'description' => 'Layout padrão.', 'path' => 'dashboard::pdfs.default', 'selected' => true]);
        PdfLayout::create(['title' => 'Estoque', 'description' => 'Layout agrupado por estoque.', 'path' => 'dashboard::pdfs.stock', 'selected' => false]);
        PdfLayout::create(['title' => 'Data', 'description' => 'Layout agrupado pela data do estoque.', 'path' => 'dashboard::pdfs.date', 'selected' => false]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pdf_layouts');
    }
}
