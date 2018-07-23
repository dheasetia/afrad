<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_specialties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('specialty')->unique();
            $table->timestamps();
        });

        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->foreign('education_specialty_id')->references('id')->on('education_specialties');
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
            $table->dropForeign('beneficiaries_education_specialty_id_foreign');
        });

        Schema::dropIfExists('education_specialties');
    }
}
