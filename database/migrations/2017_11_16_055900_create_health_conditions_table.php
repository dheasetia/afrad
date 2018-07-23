<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_conditions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('condition')->unique();
            $table->timestamps();
        });

        Schema::table('researches', function (Blueprint $table) {
            $table->foreign('health_condition_id')->references('id')->on('health_conditions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('researches', function (Blueprint $table) {
            $table->dropForeign('researches_health_condition_id_foreign');
        });

        Schema::dropIfExists('health_conditions');
    }
}
