<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watch_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('model_id')->references('id')->on('watch_models');//klucz obcy
            $table->string('nominal_name')->nullable();//nazwa znamionowa
            $table->string('mechanism')->nullable();//mechanizm
            $table->string('years_of_production')->nullable();//lata produkcji
            $table->string('watch_case_width')->nullable();//szerokość koperty
            $table->string('width_of_the_watchs_ear')->nullable();//szerokość uszu
            $table->string('ear_ear_dimension')->nullable();//wymiar ucho-ucho
            $table->string('glass')->nullable();//szkło
            $table->text('detailed_desc')->nullable();//opis szczegółowy
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
        Schema::dropIfExists('watch_products');
    }
};
