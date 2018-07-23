<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('researches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('research_kind_id')->unsigned();
            $table->integer('beneficiary_id')->unsigned();
            $table->integer('health_condition_id')->unsigned()->nullable();
            $table->text('health_description')->nullable();
            $table->integer('project_manager_id')->unsigned()->nullable();
            $table->integer('researcher_id')->unsigned()->nullable();
            $table->string('employee_name')->nullable();
            $table->string('director_name')->nullable();
            $table->integer('general_manager_id')->unsigned()->nullable();
            $table->date('research_date')->nullable();
            $table->integer('hijri_research_day')->nullable();
            $table->integer('hijri_research_month')->nullable();
            $table->integer('hijri_research_year')->nullable();
            $table->string('place')->nullable();
            $table->integer('completed')->default(0);
            $table->text('researcher_recommendation')->nullable();
            $table->timestamps();
        });

        Schema::table('income_research', function(Blueprint $table) {
            $table->foreign('research_id')->references('id')->on('researches');
        });

        Schema::table('expense_research', function(Blueprint $table) {
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
        Schema::table('income_research', function(Blueprint $table) {
            $table->dropForeign('income_research_research_id_foreign');
        });

        Schema::table('expense_research', function(Blueprint $table) {
            $table->dropForeign('expense_research_research_id_foreign');
        });

        Schema::dropIfExists('researches');
    }
}
