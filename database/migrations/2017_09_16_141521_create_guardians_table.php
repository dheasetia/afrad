<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuardiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardians', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('mobile')->unique();
            $table->string('phone')->nullable();
            $table->string('email')->unique()->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->foreign('guardian_id')->references('id')->on('guardians');
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
            $table->dropForeign('beneficiaries_guardian_id_foreign');
        });

        Schema::dropIfExists('guardians');
    }
}
