<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodicDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodic_distributions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->integer('beneficiary_id')->unsigned();
            $table->integer('distribution_type_id')->unsigned();
            $table->date('distribution_date');
            $table->integer('distribution_hijri_day');
            $table->integer('distribution_hijri_month');
            $table->integer('distribution_hijri_year');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('beneficiary_id')->references('id')->on('beneficiaries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periodic_distributions');
    }
}
