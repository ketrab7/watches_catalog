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
        Schema::table('watch_products', function (Blueprint $table) {
            $table->string('number_of_stones')->after('glass')->nullable();//liczba kamieni
            $table->enum('gender', ['men', 'women', 'unisex'])->after('number_of_stones');//płeć zegarka
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('watch_products', function (Blueprint $table) {
            $table->dropColumn('number_of_stones');
            $table->dropColumn('gender');
        });
    }
};
