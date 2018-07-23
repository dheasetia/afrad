<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role')->unique();
            $table->timestamps();
        });

        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->foreign('family_role_id')->references('id')->on('family_roles');
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
            $table->dropForeign('beneficiaries_family_role_id_foreign');
        });
        Schema::dropIfExists('family_roles');
    }
}
