<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaritalStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marital_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->unique();
            $table->timestamps();
        });

        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->foreign('marital_status_id')->references('id')->on('marital_statuses');
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
            $table->dropForeign('beneficiaries_marital_status_id_foreign');
        });

        Schema::dropIfExists('marital_statuses');
    }
}
