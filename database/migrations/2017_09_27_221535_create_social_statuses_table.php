<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->unique();
            $table->timestamps();
        });

        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->foreign('social_status_id')->references('id')->on('social_statuses');
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
            $table->dropForeign('beneficiaries_social_status_id_foreign');
        });

        Schema::dropIfExists('social_statuses');
    }
}
