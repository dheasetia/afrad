<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributionKindsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribution_kinds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kind')->unique();
            $table->timestamps();
        });

        Schema::table('distributions', function (Blueprint $table) {
            $table->foreign('distribution_kind_id')->references('id')->on('distribution_kinds');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('distributions', function (Blueprint $table) {
            $table->dropForeign('distributions_distribution_kind_id_foreign');
        });

        Schema::dropIfExists('distribution_kinds');
    }
}
