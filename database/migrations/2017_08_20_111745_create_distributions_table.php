<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('distribution_kind_id')->unsigned();
            $table->integer('beneficiary_id')->unsigned();
            $table->date('distribution_date');
            $table->time('distribution_time')->nullable();
            $table->integer('distribution_hijri_day');
            $table->integer('distribution_hijri_month');
            $table->integer('distribution_hijri_year');
            $table->integer('distribution_type_id')->unsigned()->nullable();
            $table->string('distribution_file')->nullable();
            $table->string('transfer_file')->nullable();
            $table->string('receipt_file')->nullable();
            $table->string('place')->nullable();
            $table->tinyInteger('is_periodic')->default(1);
            $table->integer('city_id')->unsigned()->nullable();
            $table->double('amount')->nullable();
            $table->timestamps();
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distributions');
    }
}
