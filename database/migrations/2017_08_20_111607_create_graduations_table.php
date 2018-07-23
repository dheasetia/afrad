<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGraduationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graduations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('graduation')->unique();
            $table->timestamps();
        });

        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->foreign('graduation_id')->references('id')->on('graduations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->dropForeign('beneficiaries_graduation_id_foreign');
        });

        Schema::dropIfExists('graduations');
    }
}
