<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribution_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->unique();
            $table->timestamps();
        });

        Schema::table('periodic_distributions', function (Blueprint $table) {
            $table->foreign('distribution_type_id')->references('id')->on('periodic_distributions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('periodic_distributions', function (Blueprint $table) {
            $table->dropForeign('periodic_distributions_distribution_type_id_foreign');
        });

        Schema::dropIfExists('distribution_types');
    }
}
