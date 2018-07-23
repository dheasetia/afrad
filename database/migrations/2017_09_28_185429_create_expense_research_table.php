<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseResearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_research', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('expense_id')->unsigned();
            $table->integer('research_id')->unsigned();
            $table->double('amount');
            $table->timestamps();

            $table->foreign('expense_id')->references('id')->on('expenses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_research');
    }
}
