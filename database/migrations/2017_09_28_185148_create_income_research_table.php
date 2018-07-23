<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomeResearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_research', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('income_id')->unsigned();
            $table->integer('research_id')->unsigned();
            $table->double('amount')->default(0);
            $table->timestamps();

            $table->foreign('income_id')->references('id')->on('incomes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('income_research');
    }
}
