<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('resident_kind_id')->unsigned();
            $table->string('owner')->nullable();
            $table->string('responsible_person')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('bank_id')->nullable();
            $table->string('iban')->nullable();
            $table->string('payment_way')->nullable();
            $table->double('annually_cost')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('resident_kind_id')->references('id')->on('resident_kinds');
        });

        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->foreign('resident_id')->references('id')->on('residents');
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
            $table->dropForeign('beneficiaries_resident_id_foreign');
        });

        Schema::dropIfExists('residents');
    }
}
