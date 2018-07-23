<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item')->unique();
            $table->timestamps();
        });

        Schema::table('distribution_items', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('distribution_items', function (Blueprint $table) {
            $table->dropForeign('distribution_items_item_id_foreign');
        });

        Schema::dropIfExists('items');
    }
}
