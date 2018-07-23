<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoneyNeedResearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_need_research', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('money_need_id')->unsigned();
            $table->integer('research_id')->unsigned();
            $table->double('amount')->default(0);
            $table->timestamps();

            $table->foreign('money_need_id')->references('id')->on('money_needs');
            $table->foreign('research_id')->references('id')->on('researches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('money_need_research');
    }
}
