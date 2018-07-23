<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            $table->integer('job_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->string('mobile')->unique();

            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('is_banned')->default(0);

            $table->string('phone')->nullable();
            $table->string('ext')->nullable();

            $table->integer('address_id')->unsigned()->nullable();

            $table->string('last_ip')->nullable();
            $table->dateTime('last_login')->nullable();

            $table->string('avatar')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
