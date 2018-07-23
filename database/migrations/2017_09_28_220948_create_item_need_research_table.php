<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemNeedResearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_need_research', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_need_id')->unsigned();
            $table->integer('research_id')->unsigned();
            $table->double('price')->default(0);
            $table->integer('quantity')->default(1);
            $table->double('cost')->default(0);
            $table->timestamps();

            $table->foreign('item_need_id')->references('id')->on('item_needs');
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
        Schema::dropIfExists('item_need_research');
    }
}
