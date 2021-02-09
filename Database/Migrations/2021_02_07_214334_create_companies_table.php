<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Dashboard\Entities\Company;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->string('cnpj', 14)->nullable();
            $table->string('corporate_name')->nullable();
            $table->string('fantasy_name')->nullable();
            $table->string('state_registration', 12)->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->string('street')->nullable();
            $table->integer('number')->nullable();
            $table->string('apartment')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('city')->nullable();
            $table->string('st', 2)->nullable();
            $table->string('postcode', 8)->nullable();

            $table->string('logo')->default('modules/dashboard/img/noimage.png')->nullable();

            $table->timestamps();
        });

        Company::create([]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
