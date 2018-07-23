<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribution_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seq_num')->nullable();
            $table->integer('distribution_id')->unsigned();
            $table->integer('is_money')->default(1);
            $table->integer('item_id')->unsigned();
            $table->double('cost')->default(0);
            $table->integer('quantity')->default(1);
            $table->double('subtotal')->default(0);
            $table->tinyInteger('is_received')->default(0);
            $table->text('notes');
            $table->timestamps();

            $table->foreign('distribution_id')->references('id')->on('distributions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distribution_items');
    }
}
