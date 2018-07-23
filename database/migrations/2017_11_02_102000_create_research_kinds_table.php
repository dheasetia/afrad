<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchKindsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_kinds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kind');
            $table->timestamps();
        });

        Schema::table('researches', function (Blueprint $table) {
            $table->foreign('research_kind_id')->references('id')->on('research_kinds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('researches', function (Blueprint $table) {
            $table->dropForeign('researches_research_kind_id_foreign');
        });
        Schema::dropIfExists('research_kinds');
    }
}
