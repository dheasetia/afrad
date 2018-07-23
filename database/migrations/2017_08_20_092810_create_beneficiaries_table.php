<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('mobile');
            $table->string('phone')->nullable();
            $table->string('national_number')->unique();
            $table->integer('nationality_id')->unsigned();
            $table->string('email')->nullable();
            $table->string('sex')->default('ذكر');
            $table->date('dob')->nullable();
            $table->integer('dob_hijri_day')->nullable();
            $table->integer('dob_hijri_month')->nullable();
            $table->integer('dob_hijri_year')->nullable();
            $table->integer('marital_status_id')->unsigned();
            $table->integer('family_role_id')->unsigned();
            $table->integer('family_member_count')->nullable();
            $table->integer('son_count')->nullable();
            $table->integer('daughter_count')->nullable();
            $table->integer('expertise_id')->unsigned()->nullable();
            $table->integer('social_status_id')->unsigned()->nullable();
            $table->integer('graduation_id')->unsigned()->nullable();
            $table->integer('education_specialty_id')->unsigned()->nullable();
            $table->string('work_experience')->nullable()->nullable();
            $table->integer('profession_id')->unsigned()->nullable();
            $table->string('company_name')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('is_banned')->default(0);
            $table->string('ban_reason')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('guardian_id')->unsigned()->nullable();
            $table->integer('social_type_id')->unsigned()->nullable();
            $table->integer('bank_id')->unsigned()->nullable();
            $table->string('iban')->nullable()->nullable();
            $table->integer('address_id')->unsigned()->nullable();
            $table->integer('resident_id')->unsigned()->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('beneficiaries');
    }
}
