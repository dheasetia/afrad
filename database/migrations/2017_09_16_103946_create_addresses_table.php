<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_id')->unsigned();
            $table->string('building_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('street')->nullable();
            $table->string('district')->nullable();
            $table->string('building_no')->nullable();
            $table->string('additional_no')->nullable();
            $table->string('po_box')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('coordinate')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities');
        });
        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('addresses');
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
            $table->dropForeign('beneficiaries_address_id_foreign');
        });
        Schema::dropIfExists('addresses');
    }
}
