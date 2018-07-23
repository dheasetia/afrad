<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->string('path')->nullable();
            $table->integer('beneficiary_id')->unsigned();
            $table->integer('document_type_id')->unsigned()->nullable();
            $table->string('extension')->nullable();
            $table->date('expiry_date')->nullable();
            $table->integer('expiry_hijri_day')->nullable();
            $table->integer('expiry_hijri_month')->nullable();
            $table->integer('expiry_hijri_year')->nullable();
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
        Schema::dropIfExists('documents');
    }
}
